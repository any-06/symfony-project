import Swiper from "swiper";
import "swiper/css";
import "swiper/css/pagination";

const swiper = new Swiper(".swiper-image", {
  // Optional parameters
  direction: "horizontal",
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: true,
  },
  grabCursor: true,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },
});
