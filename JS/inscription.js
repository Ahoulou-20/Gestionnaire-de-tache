function validateForm() {
  // Obtenir les valeurs des champs
  let nom = document.getElementById("name").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirmPassword").value;

  let errorDiv = document.getElementById("error");

  const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

  // Vérifier les champs vides
  if (nom === "" || email === "" || password === "" || confirmPassword === "") {
    errorDiv.textContent = "Pas de champs vides svp !";
    alert("Respecter les instructions");
    return false;
  }

  // vérification
  if (!regex.test(password)) {
    errorDiv.textContent =
      "Le mot de passe doit contenir au moins 8 caractères, comprenant des chiffres et des lettres.";
    alert("Le mot de passe ne respecte pas les conditions fixées");
    return false;
  }

  // vérification de la correspondance des mots de passe
  if (password !== confirmPassword) {
    errorDiv.textContent = "Les mots de passe ne correspondent pas.";
    alert("Les mots de passe ne correspondent pas");
    return false;
  }

  errorDiv.textContent = "";
  return true;
}
