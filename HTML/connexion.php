<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

</head>

<body>
    <form class="box-shadow" id="signupForm" onsubmit="return validateForm()" method="POST"
        enctype="multipart/form-data" action="./request/connexion-request.php">

        <a href="index.php" class="croix">
            <i class="las la-times-circle"></i>
        </a>
        <h1>Connexion</h1>
        <em><span>*</span> désigne un champs obligatoire</em>


        <div class="form-group">
            <label for="email">Email:<span>*</span></label>
            <input type="email" id="email" name="email" placeholder="jeanmouton@gmail.com">
        </div>


        <div class="form-group">
            <label for="password">Mot de passe:<span>*</span></label>
            <input type="password" id="password" name="password"
                placeholder="chiffres et lettres obligatoire plus de 8 caractères">

            <div id="error" class="error"></div>
        </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Se connecter">
        </div>
        <div class="form-group">
            <p>Pas de compte? <a href="./inscription.php" style="text-decoration:none">S'inscrire...</a></p>
        </div>
    </form>
    <!-- <script src="../JS/connexion.js" defer></script> -->
    <script>
        function validateForm() {
            // Obtenir les valeurs des champs email et mot de passe
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            // Obtenir la div d'erreur
            let errorDiv = document.getElementById("error");

            const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;



            // Vérifier si l'un des champs est vide
            if (email === "" || password === "") {
                alert("Respecter les instructions")
                errorDiv.textContent = "pas de champs vides svp !";
                return false; // Empêcher la soumission du formulaire
            }
            if (!regex.test(password)) {
                errorDiv.textContent = 'Le mot de passe doit contenir au moins 8 caractères, comprenant des chiffres et des lettres.';
                alert('Le mot de passe ne respecte pas les conditions fixées');

                return false;
            }

            // Effacer le message d'erreur si les deux champs sont remplis
            errorDiv.textContent = "";
            return true; // Permettre la soumission du formulaire
        }
    </script>
</body>

</html>