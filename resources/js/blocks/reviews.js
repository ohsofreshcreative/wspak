import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const initSliderSwiper = (scope = document) => {
	const swiperElements = scope.querySelectorAll(
		'.reviews-swiper:not(.swiper-initialized), .slider-swiper:not(.swiper-initialized)'
	);

	if (!swiperElements.length) return;

	swiperElements.forEach((swiperEl) => {
		const section = swiperEl.closest('section') || scope;
		const nextEl = section.querySelector('.__next');
		const prevEl = section.querySelector('.__prev');
		const paginationEl = swiperEl.querySelector('.swiper-pagination');

		new Swiper(swiperEl, {
			modules: [Navigation, Pagination],

			slidesPerView: 1,
			spaceBetween: 0,
			centeredSlides: true,
			loop: true,
			speed: 600,
			observer: true,
			observeParents: true,

			breakpoints: {
				768: {
					slidesPerView: 'auto',
					spaceBetween: 24,
				},
			},

			pagination: paginationEl
				? { el: paginationEl, clickable: true }
				: false,

			navigation: {
				nextEl,
				prevEl,
			},
		});
	});
};

initSliderSwiper();

if (window.acf) {
	window.acf.addAction('render_block', (el) => {
		const node = el?.[0] ?? el;
		if (node) initSliderSwiper(node);
	});
}

export default initSliderSwiper;
