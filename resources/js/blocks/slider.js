import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

const initSlider = () => {
  const sliders = document.querySelectorAll('.slider-standard');
  if (!sliders.length) return;

  sliders.forEach((slider) => {
    // Szukamy sekcji nadrzędnej, żeby przypisać unikalne strzałki
    const parentSection = slider.closest('section');

    new Swiper(slider, {
      modules: [Navigation],
      loop: true,
      grabCursor: true,
      slidesPerView: 1,       // ZAWSZE jeden slajd na stronie
      spaceBetween: 40,       // Odstęp między slajdami podczas przejścia
      autoHeight: true,       // Dostosuje wysokość do zawartości
      navigation: {
        nextEl: parentSection.querySelector('.js-slider-next'),
        prevEl: parentSection.querySelector('.js-slider-prev'),
      },
    });
  });
};

initSlider();