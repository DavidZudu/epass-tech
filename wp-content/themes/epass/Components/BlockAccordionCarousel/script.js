import Swiper from "swiper/bundle";

document
  .querySelectorAll('[name="BlockAccordionCarousel"]')
  .forEach((component) => {
    const swiperEl = component.querySelector(".accordion-carousel");
    const accordionEls = component.querySelectorAll(".dc-accordion");
    const oneImage = component.classList.contains("one-image");
console.log("oneImage", oneImage);


    const swiperInstance = new Swiper(swiperEl, {
      watchSlidesProgress: true,
      slidesPerView: 1,
      allowTouchMove: false, // disables swipe/drag
      navigation: false, // disables next/prev buttons if used
      spaceBetween: 0,
      loop: false,
      autoHeight: true,
      autoplay: oneImage ? false : {
        delay: 4000, // Time in ms between slides (3000ms = 3s)
        disableOnInteraction: false, // Keep autoplay running after user interactions
      },
      effect: "fade",
      fadeEffect: {
        crossFade: true, // optional but gives smoother transitions
      },
    });

    if (oneImage) {
      return;
     }

    // Link accordion clicks to swiper slides
    accordionEls.forEach((accordion) => {
      accordion.addEventListener("click", () => {
        const index = parseInt(accordion.getAttribute("data-slide"), 10);
        swiperInstance.slideTo(index);
      });
      accordion.addEventListener("mouseenter", () => {
        swiperInstance.autoplay?.stop();
      });
      accordion.addEventListener("mouseleave", () => {
        swiperInstance.autoplay?.start();
      });
    });

    // Optional: Sync active accordion on slide change
    swiperInstance.on("slideChange", () => {
      const activeIndex = swiperInstance.realIndex;

      accordionEls.forEach((el, idx) => {
        const instance = el._accordionInstance;

        if (idx === activeIndex) {
          el.classList.add("active");
          instance?.open(); // 🔥 Animate open
        } else {
          el.classList.remove("active");
          if (el.open) {
            instance?.shrink(); // 🔥 Animate close
          }
        }
      });
    });
  });
