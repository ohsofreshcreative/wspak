import Alpine from 'alpinejs';

// --- 1. Kod do filtrowania lektorów ---
document.addEventListener('DOMContentLoaded', () => {
	const section = document.querySelector('.b-voices');

	if (section) {
		const checkboxes = section.querySelectorAll('.voice-filter');
		const cards = section.querySelectorAll('.voice-card');
		const searchInput = section.querySelector('#voice-search');

		function applyFilters() {
			const active = {};

			const search = searchInput
				? searchInput.value.trim().toLowerCase()
				: '';

			checkboxes.forEach(cb => {
				if (cb.checked) {
					if (!active[cb.dataset.filter]) {
						active[cb.dataset.filter] = new Set();
					}

					active[cb.dataset.filter].add(cb.value);
				}
			});

			const hasActiveFilters = Object.keys(active).some(
				key => active[key].size > 0
			);
			cards.forEach(card => {
				const isMatch = !hasActiveFilters || Object.entries(active).every(([key, values]) => {
					if (!values || values.size === 0) return true;

					const cardValues = (card.dataset[key] || '')
						.split(',')
						.map(v => v.trim());

					return cardValues.some(cardValue => values.has(cardValue));
				});

				const matchesSearch =
					search === '' ||
					(card.dataset.name || '').includes(search);

				card.style.display = (isMatch && matchesSearch) ? '' : 'none';
			});

		}

		checkboxes.forEach(cb =>
			cb.addEventListener('change', applyFilters)
		);
		if (searchInput) {
			searchInput.addEventListener('input', applyFilters);
		}
	}
});

// --- 2. Audio Player ---
Alpine.data('audioPlayer', (audioSrc) => ({
	isPlaying: false,
	progress: 0,
	audioSrc,

	init() {
		const audio = this.$refs.audio;

		if (!audio) return;

		audio.addEventListener('play', () => {
			this.isPlaying = true;
		});

		audio.addEventListener('pause', () => {
			this.isPlaying = false;
		});

		audio.addEventListener('timeupdate', () => {
			if (audio.duration) {
				this.progress = (audio.currentTime / audio.duration) * 100;
			}
		});

		audio.addEventListener('ended', () => {
			this.progress = 0;
			audio.currentTime = 0;
			this.isPlaying = false;
		});

		window.addEventListener('player-started', (event) => {
			if (event.detail.player !== this) {
				audio.pause();
				audio.currentTime = 0;
				this.progress = 0;
			}
		});
	},

	togglePlay() {
		const audio = this.$refs.audio;

		if (!audio) return;

		if (audio.paused) {
			// zatrzymaj wszystkie pozostałe playery
			window.dispatchEvent(
				new CustomEvent('player-started', {
					detail: { player: this }
				})
			);

			audio.play().catch(error => {
				console.error('Błąd odtwarzania:', error);
			});
		} else {
			audio.pause();
		}
	}
}));