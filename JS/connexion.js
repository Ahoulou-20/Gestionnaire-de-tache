function validateForm() {
  // Obtenir les valeurs des champs email et mot de passe
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Obtenir la div d'erreur
  const errorDiv = document.getElementById("error");

  // Vérifier si l'un des champs est vide
  if (email === "" || password === "") {
    errorDiv.textContent = "Veuillez remplir tous les champs obligatoires.";
    return false; // Empêcher la soumission du formulaire
  }

  // Effacer le message d'erreur si les deux champs sont remplis
  errorDiv.textContent = "";
  return true; // Permettre la soumission du formulaire
}
