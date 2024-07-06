<?php
include ('./server/verif.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout</title>
    <link rel="stylesheet" href="../CSS/ajouter.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

</head>

<body>

    <form id="taskForm" onsubmit="return validateForm()" method="POST" action="./request/ajouter-request.php">
        <a href="user.php" class="croix">
            <i class="las la-times-circle"></i>
        </a>
        <h1>Nouvelle tâche</h1>
        <em><span>*</span> désigne un champs obligatoire</em>
        <div class="form-group">
            <label for="name">Nom de la tâche:<span>*</span></label>
            <input type="text" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Description:<span>*</span> </label>
            <textarea class="box-shadow" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date:<span>*</span></label>
            <input type="date" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="time">Heure:<span>*</span></label>
            <input type="time" id="time" name="time">
        </div>
        <div class=" priorite">
            <input type="radio" id="priorite" value="true" name="priorite">
            <label for="priorite">prioritaire<span>*</span></label>
        </div>
        <div id="error" class="error"></div>

        <div class="form-group">
            <input type="submit" value="Ajouter la tâche">
        </div>
    </form>
    <script src="../JS/ajouter.js" defer></script>
</body>

</html>