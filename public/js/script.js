// Burger Menu

function menuChange(x) {
  x.classList.toggle("change");
}

const menuburger = document.querySelector(".menuburger");
const navlinks = document.querySelector("ul");

menuburger.addEventListener("click", () => {
  navlinks.classList.toggle("mobile-menu");
});
