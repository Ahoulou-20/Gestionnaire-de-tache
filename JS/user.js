let urlActif = "accueil";
let listAccueil = document.querySelector(".lien-accueil");
let listTaches = document.querySelector(".lien-taches");

const links = document.querySelectorAll("li .lien");

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    let urle = e.target.href;
    let urleList = urle.split("#");
    let urleFinal = urleList[urleList.length - 1];
    if (urleFinal !== urlActif) {
      switch (urlActif) {
        case "accueil":
          document.getElementById("champsCourant").textContent = "MES TÂCHES";
          listAccueil.style.backgroundColor = "";
          document.getElementById("accueil").style.display = "none";
          listTaches.style.backgroundColor = "#44bba4";
          document.getElementById("tache").style.display = "block";
          urlActif = urleFinal;
          break;
        default:
          document.getElementById("champsCourant").textContent = "ACCUEIL";
          listTaches.style.backgroundColor = "";
          document.getElementById("tache").style.display = "none";
          listAccueil.style.backgroundColor = "#44bba4";
          document.getElementById("accueil").style.display = "block";
          urlActif = urleFinal;
      }
    }
  });
});
