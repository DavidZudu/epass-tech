import Swiper from "swiper/bundle";

document
  .querySelectorAll('[name="BlockAccordionCarousel"]')
  .forEach((component) => {
    const swiperEl = component.querySelector(".accordion-carousel");
    const accordionEls = component.querySelectorAll(".dc-accordion");

    const swiperInstance = new Swiper(swiperEl, {
      watchSlidesProgress: true,
      slidesPerView: 1,
      allowTouchMove: false,   // disables swipe/drag
  navigation: false,       // disables next/prev buttons if used
      spaceBetween: 0,
      loop: false,
      autoHeight: true,
      effect: "fade",
      fadeEffect: {
        crossFade: true, // optional but gives smoother transitions
      },
    });

    // Link accordion clicks to swiper slides
    accordionEls.forEach((accordion) => {
      accordion.addEventListener("click", () => {
        const index = parseInt(accordion.getAttribute("data-slide"), 10);
        swiperInstance.slideTo(index);
      });
    });

    // Optional: Sync active accordion on slide change
    swiperInstance.on("slideChange", () => {
      const activeIndex = swiperInstance.realIndex;
      accordionEls.forEach((el, idx) => {
        el.classList.toggle("active", idx === activeIndex);
      });
    });
  });
