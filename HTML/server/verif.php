<?php
session_start();
//verif.php
if (!isset($_SESSION['nom_user'])) {
    header('Location:./index.php');
    exit;
}