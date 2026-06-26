const section = document.querySelector('.voices-section');
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

        cards.forEach(card => {
            const isMatch = Object.entries(active).every(([key, values]) => {
                return values.has(card.dataset[key]);
            });

            card.style.display = isMatch ? '' : 'none';
        });
    }

    checkboxes.forEach(cb => cb.addEventListener('change', applyFilters));
}
