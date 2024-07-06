//Menu flotant
let tailleEcran = window.innerWidth;

if (tailleEcran < "641px") {
  let barLeft = document.getElementById("bar_gauche");
  let barRight = document.getElementById("bar_droite");

  let aside = document.querySelector("aside");

  barRight.addEventListener("mouseover", (e) => {
    e.preventDefault();
    aside.style.display = "block";
  });

  barLeft.addEventListener("click", (e) => {
    e.preventDefault();
    aside.style.display = "none";
  });
}
