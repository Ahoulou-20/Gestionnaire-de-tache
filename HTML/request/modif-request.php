<?php
include ('../server/db_infos.php');
include ('../server/db.php');
include ('../server/users.php');


session_start();

// Instance de la classe Database et obtenir la connexion
$db = new Database();
$connect = $db->get_connexion();


$tacheSup = $_GET['id'];
// Instance de la classe User en passant la connexion
$user = new User($connect);
$user->email_user = $_SESSION['user_email'];
$user->nom_tache = $_POST['name'];
$user->description_tache = $_POST['description'];
$user->date_tache = $_POST['date'];
$user->heure_tache = $_POST['time'];
$user->statut_tache = $_POST['statut'];
$user->priorite_tache = $_POST['priorite'];
if ($user->modifierTaches($tacheSup)) {
    header('Location: ../user.php');
    exit;
}
