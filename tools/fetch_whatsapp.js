import {
    makeWASocket,
    useMultiFileAuthState,
    fetchLatestBaileysVersion,
    DisconnectReason,
    Browsers
} from '@whiskeysockets/baileys';
import pino from 'pino';
import { writeFileSync } from 'fs';
import { join, dirname } from 'path';
import { fileURLToPath } from 'url';
import 'dotenv/config';

const __dirname = dirname(fileURLToPath(import.meta.url));

// --- Configuration ---
const GROUP_ID = process.env.WHATSAPP_GROUP_ID;
const AUTH_DIR = join(__dirname, 'auth_state');
const OUTPUT_FILE = join(__dirname, 'whatsapp_messages.txt');

// Argument --days N (défaut 30)
const daysArg = process.argv.indexOf('--days');
const DAYS_BACK = daysArg !== -1 && process.argv[daysArg + 1]
    ? parseInt(process.argv[daysArg + 1], 10)
    : 30;

// Argument --list-groups : lister les groupes et quitter
const LIST_GROUPS = process.argv.includes('--list-groups');

// --- Validation ---
if (!LIST_GROUPS && !GROUP_ID) {
    console.error('Erreur : WHATSAPP_GROUP_ID non défini dans .env');
    console.error('Utilisez --list-groups pour trouver l\'ID du groupe.');
    process.exit(1);
}

// --- Fonctions utilitaires ---

function formatDate(timestamp) {
    const d = new Date(timestamp * 1000);
    const dd = String(d.getDate()).padStart(2, '0');
    const mm = String(d.getMonth() + 1).padStart(2, '0');
    const yyyy = d.getFullYear();
    const hh = String(d.getHours()).padStart(2, '0');
    const min = String(d.getMinutes()).padStart(2, '0');
    return `[${dd}/${mm}/${yyyy} ${hh}:${min}]`;
}

function extractTextFromMessage(msg) {
    if (!msg.message) return null;
    const m = msg.message;
    return m.conversation
        || m.extendedTextMessage?.text
        || m.imageMessage?.caption
        || m.videoMessage?.caption
        || null;
}

function getSenderName(msg) {
    return msg.pushName || msg.key.participant?.split('@')[0] || 'Inconnu';
}

// --- Script principal ---

async function main() {
    console.log('Connexion à WhatsApp...');

    const { state, saveCreds } = await useMultiFileAuthState(AUTH_DIR);
    const { version } = await fetchLatestBaileysVersion();

    const collectedMessages = [];
    let syncDone = false;

    const sock = makeWASocket({
        version,
        auth: state,
        browser: Browsers.ubuntu('Kannagara'),
        logger: pino({ level: 'silent' }),
        printQRInTerminal: true,
        syncFullHistory: true
    });

    sock.ev.on('creds.update', saveCreds);

    // Collecter les messages de l'historique
    sock.ev.on('messaging-history.set', ({ messages, isLatest }) => {
        const cutoffTimestamp = Math.floor(Date.now() / 1000) - (DAYS_BACK * 24 * 60 * 60);

        for (const msg of messages) {
            if (!GROUP_ID) continue;
            if (msg.key.remoteJid !== GROUP_ID) continue;

            const timestamp = msg.messageTimestamp;
            if (timestamp < cutoffTimestamp) continue;

            const text = extractTextFromMessage(msg);
            if (!text) continue;

            collectedMessages.push({
                timestamp,
                sender: getSenderName(msg),
                text: text.trim()
            });
        }

        console.log(`  Sync: ${messages.length} messages reçus, ${collectedMessages.length} retenus du groupe`);

        if (isLatest) {
            syncDone = true;
        }
    });

    // Collecter aussi les messages en temps réel (au cas où)
    sock.ev.on('messages.upsert', ({ messages }) => {
        if (!GROUP_ID) return;
        const cutoffTimestamp = Math.floor(Date.now() / 1000) - (DAYS_BACK * 24 * 60 * 60);

        for (const msg of messages) {
            if (msg.key.remoteJid !== GROUP_ID) continue;

            const timestamp = msg.messageTimestamp;
            if (timestamp < cutoffTimestamp) continue;

            const text = extractTextFromMessage(msg);
            if (!text) continue;

            collectedMessages.push({
                timestamp,
                sender: getSenderName(msg),
                text: text.trim()
            });
        }
    });

    // Attendre la connexion
    await new Promise((resolve, reject) => {
        const timeout = setTimeout(() => {
            reject(new Error('Timeout : connexion WhatsApp'));
        }, 60000);

        sock.ev.on('connection.update', async (update) => {
            const { connection, lastDisconnect } = update;

            if (connection === 'open') {
                console.log('Connecté à WhatsApp.');
                clearTimeout(timeout);

                if (LIST_GROUPS) {
                    // Mode liste des groupes
                    try {
                        console.log('\nRécupération des groupes...');
                        const groups = await sock.groupFetchAllParticipating();
                        console.log('\nGroupes disponibles :');
                        console.log('─'.repeat(80));
                        for (const group of Object.values(groups)) {
                            console.log(`  ${group.subject}`);
                            console.log(`  ID: ${group.id}`);
                            console.log(`  Participants: ${group.participants.length}`);
                            console.log('');
                        }
                        console.log('─'.repeat(80));
                        console.log('\nCopiez l\'ID du groupe souhaité dans WHATSAPP_GROUP_ID du fichier .env');
                    } catch (err) {
                        console.error('Erreur lors de la récupération des groupes:', err.message);
                    }
                    sock.end();
                    resolve();
                    return;
                }

                // Mode récupération des messages : attendre la synchronisation
                console.log(`Récupération des messages des ${DAYS_BACK} derniers jours...`);

                // Attendre que la sync soit terminée (max 30 secondes)
                let waitCount = 0;
                const checkSync = setInterval(() => {
                    waitCount++;
                    if (syncDone || waitCount >= 30) {
                        clearInterval(checkSync);
                        writeMessages();
                        sock.end();
                        resolve();
                    }
                }, 1000);
            }

            if (connection === 'close') {
                const statusCode = lastDisconnect?.error?.output?.statusCode;
                if (statusCode === DisconnectReason.loggedOut) {
                    console.error('Session expirée. Relancez le script pour scanner un nouveau QR code.');
                    clearTimeout(timeout);
                    reject(new Error('Logged out'));
                }
            }
        });
    });

    function writeMessages() {
        // Trier par timestamp
        collectedMessages.sort((a, b) => a.timestamp - b.timestamp);

        // Dédupliquer
        const seen = new Set();
        const unique = collectedMessages.filter(msg => {
            const key = `${msg.timestamp}-${msg.sender}-${msg.text}`;
            if (seen.has(key)) return false;
            seen.add(key);
            return true;
        });

        if (unique.length === 0) {
            console.log('\nAucun message texte trouvé dans le groupe pour cette période.');
            writeFileSync(OUTPUT_FILE, '', 'utf-8');
            return;
        }

        // Formater et écrire
        const lines = unique.map(msg =>
            `${formatDate(msg.timestamp)} ${msg.sender}: ${msg.text}`
        );

        writeFileSync(OUTPUT_FILE, lines.join('\n') + '\n', 'utf-8');
        console.log(`\n${unique.length} messages écrits dans ${OUTPUT_FILE}`);
    }
}

main().catch(err => {
    console.error('Erreur:', err.message);
    process.exit(1);
});
