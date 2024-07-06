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
if ($user->suppressionTaches($tacheSup)) {
    header('Location: ../user.php');
    exit;
}
