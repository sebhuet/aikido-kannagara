<?php
/**
 * Handler pour le formulaire de pré-inscription.
 * Valide les données, envoie un email et redirige vers inscription.php.
 */

// Seulement POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: inscription.php');
    exit;
}

// Destinataire
$to = 'aikido.kannagara.guyancourt@gmail.com';

// Récupération et nettoyage des champs
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$categorie = trim($_POST['categorie'] ?? '');
$experience = trim($_POST['experience'] ?? '');
$message = trim($_POST['message'] ?? '');
$rgpd = isset($_POST['rgpd']);

// Validation
$errors = [];
if ($nom === '') $errors[] = 'Le nom est requis.';
if ($prenom === '') $errors[] = 'Le prénom est requis.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Une adresse email valide est requise.';
if (!in_array($categorie, ['enfant', 'adulte'])) $errors[] = 'La catégorie est requise.';
if (!$rgpd) $errors[] = 'Vous devez accepter la politique de données.';

if (!empty($errors)) {
    $params = http_build_query(['erreur' => implode(' ', $errors)]);
    header("Location: inscription.php?$params#preinscription");
    exit;
}

// Labels lisibles
$categorieLabel = $categorie === 'enfant' ? 'Enfant (7-14 ans)' : 'Adulte (15 ans et +)';
$experienceLabels = [
    'debutant' => 'Débutant complet',
    'initie' => 'Quelques cours',
    'pratiquant' => 'Pratiquant (grade précisé dans le message)',
];
$experienceLabel = $experienceLabels[$experience] ?? 'Non précisé';

// Construction du message email
$body = "Nouvelle pré-inscription via le site kannagara.fr\n";
$body .= "=============================================\n\n";
$body .= "Nom : $nom\n";
$body .= "Prénom : $prenom\n";
$body .= "Email : $email\n";
$body .= "Téléphone : " . ($telephone ?: 'Non renseigné') . "\n";
$body .= "Catégorie : $categorieLabel\n";
$body .= "Expérience : $experienceLabel\n";
$body .= "\nMessage :\n" . ($message ?: '(aucun)') . "\n";
$body .= "\n-----\nConsentement RGPD : Oui\n";

// En-têtes email
$subject = "Nouvelle pré-inscription Kannagara : $prenom $nom";
$headers = "From: noreply@kannagara.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoi
$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    header('Location: inscription.php?merci=1#preinscription');
} else {
    header('Location: inscription.php?erreur=Une erreur technique est survenue. Veuillez réessayer ou nous contacter directement par email.#preinscription');
}
exit;
