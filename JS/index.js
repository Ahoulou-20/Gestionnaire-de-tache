document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".gestimg-container");
  const image = document.querySelector(".gest");

  container.addEventListener("mousemove", function (e) {
    const rect = container.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const width = container.offsetWidth;
    const height = container.offsetHeight;
    const xPercent = (x / width) * 100;
    const yPercent = (y / height) * 100;

    image.style.transformOrigin = `${xPercent}% ${yPercent}%`;
    image.style.transform = "scale(1.3)";
  });

  container.addEventListener("mouseleave", function () {
    image.style.transform = "scale(1)";
    image.style.transformOrigin = "center center";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const options = {
    root: null, // Par rapport à la fenêtre de visualisation
    rootMargin: "0px",
    threshold: 0.3,
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      } else {
        entry.target.classList.remove("visible");
      }
    });
  }, options);

  const sections = document.querySelectorAll("main > *");
  sections.forEach((section) => {
    observer.observe(section);
  });
});
