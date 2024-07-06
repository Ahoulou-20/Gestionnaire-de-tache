function validateForm() {
  let name = document.getElementById("name").value;
  let description = document.getElementById("description").value;
  let date = document.getElementById("date").value;
  let time = document.getElementById("time").value;
  let priorite = document.querySelector('input[name="priorite"]:checked');

  let errorDiv = document.getElementById("error");

  // vérification pour voir si tous les champs sont bien remplis vides
  if (name === "" || description === "" || date === "" || time === "") {
    alert("Tous les champs sont obligatoires ");
    errorDiv.textContent =
      "Tous les champs obligatoires doivent être remplis !";
    return false; // Empêcher la soumission du formulaire
  }

  errorDiv.textContent = "";
  return true;
}
