const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".category h1", {
  ...scrollRevealOption,
  delay: 1000,
});
// ScrollReveal().reveal(".container__left .container__btn", {
//   ...scrollRevealOption,
//   delay: 500,
// });

ScrollReveal().reveal(".content", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".home-products h1", {
  ...scrollRevealOption,
  delay: 1000,
});
// ScrollReveal().reveal(".container__right h3", {
//   ...scrollRevealOption,
//   delay: 3000,
// });
// ScrollReveal().reveal(".container__right p", {
//   ...scrollRevealOption,
//   delay: 3500,
// });

// ScrollReveal().reveal(".container__right .tent-1", {
//   duration: 1000,
//   delay: 4000,
// });
// ScrollReveal().reveal(".container__right .tent-2", {
//   duration: 1000,
//   delay: 4500,
// });

ScrollReveal().reveal(".footer", {
  ...scrollRevealOption,
  origin: "left",
  delay: 500,
});

// ScrollReveal().reveal("#nav-links", {
//   ...scrollRevealOption,
//   origin: "top",
//   delay: 1000,
//   interval: 500,
// });
