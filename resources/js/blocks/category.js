import Swiper from 'swiper';
import { Pagination, Navigation } from 'swiper/modules'; // Dodano Navigation

import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation'; // Dodano style nawigacji

const initSlider = () => {
  const sliders = document.querySelectorAll('.posts-slider');
  if (!sliders.length) {
    return;
  }

  sliders.forEach((slider) => {
    // Pobieramy najbliższą sekcję, by strzałki nie kolidowały z innymi blokami
    const section = slider.closest('.b-category'); 

    new Swiper(slider, {
      modules: [Pagination, Navigation], // Dodano Navigation do modułów
      loop: true,
      grabCursor: true,
      centeredSlides: false,
      slidesPerView: 1,
      spaceBetween: 24,
      navigation: {
        nextEl: section ? section.querySelector('.js-posts-next') : '.js-posts-next',
        prevEl: section ? section.querySelector('.js-posts-prev') : '.js-posts-prev',
      },
      pagination: {
        el: slider.querySelector('.swiper-pagination'),
        clickable: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1.1,
        },
        580: {
          slidesPerView: 1.5,
        },
        767: {
          slidesPerView: 2.5,
        },
        992: {
          slidesPerView: 2.5,
        },
        1400: {
          slidesPerView: 3.1,
        },
      },
    });
  });
};

initSlider();