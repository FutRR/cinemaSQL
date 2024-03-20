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
  const scene_swiper = new Swiper(".scene-swiper", {
    // Optional parameters
    direction: "horizontal",
    loop: true,

    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const coverflow_swiper = new Swiper(".coverflow-swiper", {
    // Optional parameters
    loop: false,
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 3,
    initialSlide: 1,
    coverflowEffect: {
      rotate: 20,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
});
