<?php
include ('../server/db_infos.php');
include ('../server/db.php');
include ('../server/users.php');

// Instance de la classe Database et obtenir la connexion
$db = new Database();
$connect = $db->get_connexion();

// Instance de la classe User en passant la connexion
$user = new User($connect);
if ($user->deconnexionUser()) {
    header('Location: ../index.php');
    exit;
} else {
    header('Location:../user.php');
}