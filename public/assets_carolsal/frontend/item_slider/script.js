var swiper = new Swiper(".swiper-container", {
   autoplay: {
    delay: 3000,
  },
  clickable:'true',
  slidesPerGroup:1,
  effect: "coverflow",
   loop: true,
  centeredSlides: true,
  slideToClickedSlide: true, 
allowTouchMove: true,
  grabCursor: false,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 50,
    modifier: 2,
    slideShadows: true
  },
  pagination: {
    el: ".swiper-pagination"
  }
});

var swiper = new Swiper(".swiper-container02", {
  autoplay: {
    delay: 3000,
  },
  clickable:'true',
  slidesPerGroup:1,
  effect: "coverflow",
  loop: true,
  centeredSlides: true,
  slideToClickedSlide: true,
  allowTouchMove: true,
  grabCursor: false,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 50,
    modifier: 2,
    slideShadows: true
  },
  pagination: {
    el: ".swiper-pagination"
  }
});

