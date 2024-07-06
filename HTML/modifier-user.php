<?php
include ('./server/db_infos.php');
include ('./server/db.php');
include ('./server/users.php');

include ('./server/verif.php');



// Instance de la classe Database et obtenir la connexion
$db = new Database();
$connect = $db->get_connexion();

// Instance de la classe User en passant la connexion
$user = new User($connect);
$user->email_user = $_SESSION['user_email'];
$idsupr = $_GET['id'];
$resultats = $user->contenuTache($idsupr);
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifer</title>
    <link rel="stylesheet" href="../CSS/ajouter.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">


</head>

<body>

    <form id="taskForm" onsubmit="return validateForm()" method="POST"
        action="./request/modif-request.php?id=<?php echo $idsupr ?>">
        <a href="user.php" class="croix">
            <i class="las la-times-circle"></i>
        </a>
        <h1>Modifier tâche</h1>
        <em><span>*</span> désigne un champs obligatoire</em>
        <div class="form-group">
            <label for="name">Nom de la tâche:<span>*</span></label>
            <input type="text" id="name" name="name" value="<?php echo $resultats['nom_tache'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:<span>*</span> </label>
            <textarea class="box-shadow" id="description"
                name="description"><?php echo $resultats['description_tache'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date:<span>*</span></label>
            <input type="date" id="date" name="date" value="<?php echo $resultats['date_tache'] ?>">
        </div>
        <div class="form-group">
            <label for="time">Heure:<span>*</span></label>
            <input type="time" id="time" name="time" value="<?php echo $resultats['heure_tache'] ?>">
        </div>
        <div class=" priorite">
            <input type="radio" id="priorite" value="true" name="priorite" value="true">
            <label for="priorite">prioritaire<span>*</span></label>
        </div>
        <div class=" priorite">
            <input type="radio" id="statut" value="1" name="statut">
            <label for="statut">terminé<span>*</span></label>
        </div>
        <div id="error" class="error"></div>

        <div class="form-group">
            <input type="submit" value="Ajouter la tâche">
        </div>
    </form>
    <script src="../JS/modifer.js" defer></script>
</body>

</html>