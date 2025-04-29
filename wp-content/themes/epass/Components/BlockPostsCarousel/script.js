import Swiper from 'swiper/bundle';


  new Swiper('.post-carousel', {
    watchSlidesProgress: true,
    slidesPerView: 1.2,
    spaceBetween: 16,
    loop: false,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
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

