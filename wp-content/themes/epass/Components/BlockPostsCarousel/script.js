import Swiper from 'swiper/bundle';


document.querySelectorAll('.post-carousel').forEach((carousel) => {
  const swiper = new Swiper(carousel, {
    watchSlidesProgress: true,
    slidesPerView: 1.2,
    spaceBetween: 16,
    loop: false,
    navigation: {
      nextEl: carousel.previousElementSibling.querySelector('.button-next'),
      prevEl: carousel.previousElementSibling.querySelector('.button-prev'),
    },
    pagination: {
      el: carousel.querySelector('.swiper-pagination'),
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      }
    }
  });
});
