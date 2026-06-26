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
		const wrapper = swiperEl.querySelector('.swiper-wrapper');
		if (!wrapper) return;

		let originalCount = Number(swiperEl.dataset.originalSlideCount || 0);
		if (!swiperEl.dataset.loopPrepared) {
			const originalSlides = Array.from(wrapper.children);
			originalCount = originalSlides.length;

			if (!originalCount) return;

			const prependFragment = document.createDocumentFragment();
			const appendFragment = document.createDocumentFragment();

			originalSlides.forEach((slide) => {
				prependFragment.appendChild(slide.cloneNode(true));
				appendFragment.appendChild(slide.cloneNode(true));
			});

			wrapper.prepend(prependFragment);
			wrapper.append(appendFragment);

			swiperEl.dataset.loopPrepared = 'true';
			swiperEl.dataset.originalSlideCount = String(originalCount);
		}

		originalCount = Number(swiperEl.dataset.originalSlideCount || 0);
		if (!originalCount) return;

		const section = swiperEl.closest('section') || scope;
		const nextEl = section.querySelector('.__next');
		const prevEl = section.querySelector('.__prev');
		const paginationEl = swiperEl.querySelector('.swiper-pagination');

		const realignSwiper = (swiperInstance) => {
			swiperInstance.update();
			swiperInstance.slideTo(originalCount, 0, false);
			swiperInstance.updateSlidesClasses();
		};

		const normalizeLoopPosition = (swiperInstance) => {
			if (swiperInstance.animating) return;

			const currentIndex = swiperInstance.activeIndex;
			const lastMiddleIndex = originalCount * 2 - 1;

			if (currentIndex < originalCount) {
				swiperInstance.slideTo(currentIndex + originalCount, 0, false);
			} else if (currentIndex > lastMiddleIndex) {
				swiperInstance.slideTo(currentIndex - originalCount, 0, false);
			}
		};

		const swiper = new Swiper(swiperEl, {
			modules: [Navigation, Pagination],

<<<<<<< Updated upstream
			slidesPerView: 1,
			spaceBetween: 0,
			centeredSlides: true,
			initialSlide: originalCount,
			loop: false,
=======
			slidesPerView: 'auto',
			spaceBetween: 24,
			loop: false,
			centeredSlides: true,
			initialSlide: originalCount,
>>>>>>> Stashed changes
			observer: true,
			observeParents: true,
			watchSlidesProgress: true,

<<<<<<< Updated upstream
			breakpoints: {
				768: {
					slidesPerView: 'auto',
					spaceBetween: 24,
				},
			},

=======
>>>>>>> Stashed changes
			pagination: {
				el: paginationEl,
				clickable: true,
			},

			navigation: {
				nextEl,
				prevEl,
			},

			on: {
				init(swiperInstance) {
					requestAnimationFrame(() => realignSwiper(swiperInstance));
					setTimeout(() => realignSwiper(swiperInstance), 150);
				},
				transitionEnd(swiperInstance) {
					normalizeLoopPosition(swiperInstance);
				},
				slideChange(swiperInstance) {
					normalizeLoopPosition(swiperInstance);
				},
			},
<<<<<<< Updated upstream
=======

			breakpoints: {
				768: {
					spaceBetween: 24,
				},
				1024: {
					spaceBetween: 24,
				},
			},
>>>>>>> Stashed changes
		});
	});
};

// ✅ odpalamy od razu (plik i tak będzie ładowany po warunku w app.js)
initSliderSwiper();

// ✅ ACF preview/editor
if (window.acf) {
	window.acf.addAction('render_block', (el) => {
		const node = el?.[0] ?? el;
		if (node) initSliderSwiper(node);
	});
}

<<<<<<< Updated upstream
export default initSliderSwiper;
=======
export default initSliderSwiper;
>>>>>>> Stashed changes
