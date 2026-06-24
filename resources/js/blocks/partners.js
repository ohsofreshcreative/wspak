import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/free-mode';

const initPartnersTicker = () => {
  const tickers = document.querySelectorAll('.partners-ticker');
  if (!tickers.length) return;

  tickers.forEach((ticker) => {
    const slideCount = ticker.querySelectorAll('.swiper-slide').length || 0;

      const swiper = new Swiper(ticker, {
        modules: [Autoplay],
        loop: true,
        spaceBetween: 40,
        slidesPerView: 'auto',
        allowTouchMove: false,
        speed: 4000,

        // ensure enough duplicated slides for smooth looping
        loopedSlides: Math.max(slideCount, 5),
        loopAdditionalSlides: Math.max(slideCount, 5),
        watchSlidesProgress: true,

        // watch DOM changes
        observer: true,
        observeParents: true,

        autoplay: {
          delay: 0,
          disableOnInteraction: false,
          pauseOnMouseEnter: false,
          waitForTransition: false,
        },
      });

      // Update swiper after images load to avoid layout shifts causing jumps
      const imgs = ticker.querySelectorAll('img');
      if (imgs.length) {
        imgs.forEach((img) => {
          if (img.complete) return;
          img.addEventListener('load', () => {
            swiper.update();
            swiper.autoplay.start();
          }, { once: true });
        });
        // also update after a brief timeout in case sizes change
        setTimeout(() => {
          swiper.update();
          swiper.autoplay.start();
        }, 500);
      }
    });
  
};

initPartnersTicker();