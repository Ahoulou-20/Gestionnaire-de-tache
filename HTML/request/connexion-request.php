<?php
include ('../server/db_infos.php');
include ('../server/db.php');
include ('../server/users.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connect = $db->get_connexion();

    $user = new User($connect);


    $user->email_user = $_POST['email'];
    $user->mdp_user = $_POST['password'];
    if ($user->userConnexion()) {
        header('Location: ../user.php');
        exit;
    } else {
        header('Location: ../connexion.php');
        exit;
    }

}