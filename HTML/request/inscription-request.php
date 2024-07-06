<?php
include ('../server/db_infos.php');
include ('../server/db.php');
include ('../server/users.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    // Instance de la classe Database et obtenir la connexion
    $db = new Database();
    $connect = $db->get_connexion();

    // Instance de la classe User en passant la connexion
    $user = new User($connect);

    // Récupération des données de l'utilisateur venant du formulaire
    $user->email_user = $_POST['email'];
    $user->nom_user = $_POST['name'];

    $user->mdp_user = $_POST['password'];

    // Récupération du chemin temporaire de la photo
    $user->chemin_source = $_FILES['photo']['tmp_name'];
    $photo_name = $_FILES['photo']['name'];
    $user->chemin_destination = "C:/wamp64/www/Gestionaire-de-tache/images/images_users/" . $photo_name;
    $user->chemin_destinationTrue = "../images/images_users/" . $photo_name;
    if ($user->inscriptionUser()) {
        header('Location: ../connexion.php');
        exit;
    } else {
        header('Location: ../inscription.php');
        exit;
    }

}