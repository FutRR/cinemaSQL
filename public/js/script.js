// Burger Menu

function menuChange(x) {
  x.classList.toggle("change");
}

const menuburger = document.querySelector(".menuburger");
const navlinks = document.querySelector("ul");

menuburger.addEventListener("click", () => {
  navlinks.classList.toggle("mobile-menu");
});

document.addEventListener("DOMContentLoaded", () => {
  const swiper = new Swiper(".swiper", {
    // Optional parameters
    direction: "horizontal",
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    // autoplay: {
    //   delay: 3000,
    //   disableOnInteraction: false,
    //   pauseOnMouseEnter: true,
    // },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
});
