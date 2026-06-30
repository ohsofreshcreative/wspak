import Alpine from 'alpinejs';

// --- 1. Kod do filtrowania lektorów ---
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.b-voices');
    if (section) {
        const checkboxes = section.querySelectorAll('.voice-filter');
        const cards = section.querySelectorAll('.voice-card');

        function applyFilters() {
            const active = {};
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    if (!active[cb.dataset.filter]) {
                        active[cb.dataset.filter] = new Set();
                    }
                    active[cb.dataset.filter].add(cb.value);
                }
            });

            const hasActiveFilters = Object.keys(active).some(key => active[key].size > 0);

            cards.forEach(card => {
                if (!hasActiveFilters) {
                    card.style.display = '';
                    return;
                }

                const isMatch = Object.entries(active).every(([key, values]) => {
                    if (!values || values.size === 0) return true;
                    const cardValues = (card.dataset[key] || '').split(',').map(v => v.trim());
                    return cardValues.some(cardValue => values.has(cardValue));
                });

                card.style.display = isMatch ? '' : 'none';
            });
        }

        checkboxes.forEach(cb => cb.addEventListener('change', applyFilters));
    }
});

// --- 2. Rejestracja komponentu Audio dla Alpine ---
Alpine.data('audioPlayer', (audioSrc) => ({
    isPlaying: false,
    progress: 0,
    audioSrc: audioSrc,

    init() {
        const audio = this.$refs.audio;
        if (!audio) return;

        // Liczenie czasu i postępu dla kołowego paska
        audio.addEventListener('timeupdate', () => {
            if (audio.duration) {
                this.progress = (audio.currentTime / audio.duration) * 100;
            }
        });

        // Reset przycisku i paska po zakończeniu utworu
        audio.addEventListener('ended', () => {
            this.isPlaying = false;
            this.progress = 0;
            audio.currentTime = 0;
        });

        // Nasłuchiwanie zmian stanu (zatrzymywanie innych odtwarzaczy)
        this.$watch('isPlaying', (playing) => {
            if (playing) {
                window.dispatchEvent(new CustomEvent('player-started', { detail: { player: this } }));
            }
        });
    },

    togglePlay() {
        const audio = this.$refs.audio;
        if (!audio) return;

        if (audio.paused) {
            audio.play().catch(error => {
                console.error("Autoplay zablokowany:", error);
            });
            this.isPlaying = true;
        } else {
            audio.pause();
            this.isPlaying = false;
        }
    },

    // Globalny listener zatrzymujący inne odtwarzacze
    '@player-started.window'(event) {
        if (event.detail.player !== this) {
            this.$refs.audio.pause();
            this.isPlaying = false;
        }
    }
}));