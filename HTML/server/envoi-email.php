<?php
include ('./server/db_infos.php');
include ('./server/db.php');
include ('./server/users.php');

// Instance de la classe Database et obtenir la connexion
$db = new Database();
$connect = $db->get_connexion();

// Instance de la classe User en passant la connexion
$user = new User($connect);

// Obtenez toutes les tâches de la base de données
$traitements = $user->emailTaches();

$currentDateTime = new DateTime();

foreach ($traitements as $traitement) {
    $taskDateTime = new DateTime($traitement['date_tache'] . ' ' . $traitement['heure_tache']);

    // Vérifiez si l'heure actuelle est égale à l'heure de la tâche
    if ($currentDateTime >= $taskDateTime && $traitement['statut_tache'] == 0) {
        $to = $_SESSION['user_email']; // Assurez-vous que l'email de l'utilisateur est dans la session
        $subject = "Notification de tâche";
        $message = "Bonjour,\n\nC'est le moment d'exécuter votre tâche: " . $tache['nom_tache'] . "\nDescription: " . $tache['description_tache'] . "\n\nBonne journée!";
        $headers = 'From: adoukoloi2003@gmail.com' . "\r\n" .
            'Reply-To: adoukoloi2003@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Envoyer l'email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email envoyé avec succès à " . $to . "\n";
        } else {
            echo "Échec de l'envoi de l'email à " . $to . "\n";
        }

        // Mettre à jour le statut de la tâche pour éviter l'envoi d'emails répétés
        $user->removeSatut($tache['nom_tache'], 1); // Assurez-vous d'avoir une méthode updateTaskStatus dans votre classe User
    }
}
