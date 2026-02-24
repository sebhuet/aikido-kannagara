#!/usr/bin/env python3
"""Met à jour l'agenda Kannagara depuis les messages WhatsApp via Gemini AI."""

import argparse
import os
import re
import shutil
import sys
from datetime import datetime
from pathlib import Path

from dotenv import load_dotenv
import google.generativeai as genai

# Chemins par défaut
SCRIPT_DIR = Path(__file__).parent
PROMPTS_DIR = SCRIPT_DIR / "prompts"
WHATSAPP_FILE = SCRIPT_DIR / "whatsapp_messages.txt"
AGENDA_PATH = SCRIPT_DIR.parent / "htdocs" / "agenda.md"


def load_prompt(name):
    """Charge un fichier depuis le répertoire prompts/."""
    path = PROMPTS_DIR / name
    if not path.exists():
        sys.exit(f"Erreur : fichier prompt introuvable : {path}")
    return path.read_text(encoding="utf-8").strip()


def read_whatsapp_messages(filepath):
    """Lit les messages WhatsApp exportés par fetch_whatsapp.js."""
    path = Path(filepath)
    if not path.exists():
        sys.exit(f"Erreur : fichier WhatsApp introuvable : {filepath}")
    content = path.read_text(encoding="utf-8-sig").strip()
    if not content:
        sys.exit("Erreur : le fichier WhatsApp est vide. Lancez d'abord fetch_whatsapp.js.")
    return content


def read_current_agenda(filepath):
    """Lit le fichier agenda.md actuel."""
    path = Path(filepath)
    if not path.exists():
        return ""
    return path.read_text(encoding="utf-8")


def build_prompt(whatsapp_text, current_agenda):
    """Construit le prompt complet en chargeant les templates et en injectant les placeholders."""
    template = load_prompt("user_prompt.md")
    regles = load_prompt("regles.md")
    today = datetime.now().strftime("%d/%m/%Y")

    return template.format(
        whatsapp=whatsapp_text,
        agenda=current_agenda,
        regles=regles,
        date_du_jour=today,
    )


def call_gemini(prompt, system_instruction, model_name="gemini-2.0-flash"):
    """Appelle l'API Gemini et retourne le texte généré."""
    model = genai.GenerativeModel(
        model_name=model_name,
        system_instruction=system_instruction,
        generation_config=genai.GenerationConfig(
            temperature=0.1,
            max_output_tokens=8192,
        ),
    )

    print(f"  Modèle : {model_name}")
    response = model.generate_content(prompt)

    if not response.text:
        sys.exit("Erreur : Gemini n'a retourné aucun contenu.")

    return response.text


def clean_output(raw_output):
    """Nettoie la sortie Gemini (supprime les code fences éventuelles)."""
    text = raw_output.strip()

    # Supprimer les code fences markdown
    for prefix in ("```markdown", "```md", "```"):
        if text.startswith(prefix):
            text = text[len(prefix):].strip()
            break

    if text.endswith("```"):
        text = text[:-3].strip()

    # Terminer par une seule ligne vide
    return text.rstrip() + "\n"


def validate_agenda(content):
    """Vérifie que le contenu respecte le format agenda.md. Retourne les avertissements."""
    warnings = []
    lines = content.splitlines()

    if not lines or "Agenda des cours" not in lines[0]:
        warnings.append("En-tête manquant ou incorrect")

    week_re = re.compile(r"^## Semaine du \d{2}/\d{2}/\d{4}")
    day_re = re.compile(
        r"^### (Lundi|Mardi|Mercredi|Jeudi|Vendredi|Samedi|Dimanche) \d{2}/\d{2}"
    )
    course_re = re.compile(r"^- \*\*(\d{2}h\d{2}-\d{2}h\d{2}|Fermé|Note)\*\*")

    has_weeks = False
    for line in lines:
        line = line.strip()
        if line.startswith("## Semaine"):
            has_weeks = True
            if not week_re.match(line):
                warnings.append(f"Format semaine invalide : {line}")
        elif line.startswith("### ") and not line.startswith("### Format"):
            if not day_re.match(line):
                warnings.append(f"Format jour invalide : {line}")
        elif line.startswith("- **") and "Format" not in line:
            if not course_re.match(line):
                warnings.append(f"Format cours invalide : {line}")

    if not has_weeks:
        warnings.append("Aucune semaine trouvée dans l'agenda")

    return warnings


def write_agenda(content, filepath, backup=True):
    """Écrit le fichier agenda.md avec backup horodaté."""
    path = Path(filepath)
    if backup and path.exists():
        timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
        backup_path = path.with_suffix(f".{timestamp}.bak.md")
        shutil.copy2(path, backup_path)
        print(f"  Sauvegarde : {backup_path}")

    path.write_text(content, encoding="utf-8")
    print(f"  Agenda mis à jour : {path}")


def main():
    load_dotenv(SCRIPT_DIR.parent / ".env")

    parser = argparse.ArgumentParser(
        description="Met à jour l'agenda Kannagara depuis les messages WhatsApp via Gemini AI"
    )
    parser.add_argument(
        "whatsapp_file",
        nargs="?",
        default=str(WHATSAPP_FILE),
        help=f"Chemin vers les messages WhatsApp (défaut : {WHATSAPP_FILE.name})",
    )
    parser.add_argument(
        "--agenda", "-a",
        default=str(AGENDA_PATH),
        help="Chemin vers agenda.md",
    )
    parser.add_argument(
        "--output", "-o",
        default=None,
        help="Fichier de sortie (défaut : écrase agenda.md)",
    )
    parser.add_argument(
        "--dry-run", "-n",
        action="store_true",
        help="Afficher le résultat sans écrire",
    )
    parser.add_argument(
        "--no-backup",
        action="store_true",
        help="Ne pas créer de sauvegarde",
    )
    parser.add_argument(
        "--model", "-m",
        default="gemini-2.0-flash",
        help="Modèle Gemini (défaut : gemini-2.0-flash)",
    )

    args = parser.parse_args()

    # Clé API
    api_key = os.environ.get("GEMINI_API_KEY")
    if not api_key:
        sys.exit(
            "Erreur : GEMINI_API_KEY non défini.\n"
            "Définissez-le dans .env ou en variable d'environnement."
        )
    genai.configure(api_key=api_key)

    # Lecture des entrées
    print("Lecture des messages WhatsApp...")
    whatsapp_text = read_whatsapp_messages(args.whatsapp_file)
    print(f"  {whatsapp_text.count(chr(10)) + 1} lignes lues")

    print("Lecture de l'agenda actuel...")
    current_agenda = read_current_agenda(args.agenda)

    # Construction du prompt et appel Gemini
    print("Analyse avec Gemini...")
    system_instruction = load_prompt("system.md")
    prompt = build_prompt(whatsapp_text, current_agenda)
    raw_output = call_gemini(prompt, system_instruction, args.model)

    # Nettoyage et validation
    updated_agenda = clean_output(raw_output)
    warnings = validate_agenda(updated_agenda)

    if warnings:
        print("\nAvertissements de validation :")
        for w in warnings:
            print(f"  - {w}")

    # Sortie
    if args.dry_run:
        print("\n--- RÉSULTAT (dry-run) ---\n")
        print(updated_agenda)
    else:
        print("\nÉcriture de l'agenda...")
        output_path = Path(args.output) if args.output else Path(args.agenda)
        write_agenda(updated_agenda, output_path, backup=not args.no_backup)

    print("\nTerminé.")


if __name__ == "__main__":
    main()
