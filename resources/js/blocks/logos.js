document.querySelectorAll('.js-logo-slider').forEach(slider => {
    let position = 0;
    let speed = 0.5;
    let isDragging = false;
    let startX = 0;
    let startPosition = 0;
    function animate() {
        if (!isDragging) {
            position -= speed;
        }
        if (Math.abs(position) >= slider.scrollWidth / 2) {
            position = 0;
        }
        slider.style.transform = `translateX(${position}px)`;
        requestAnimationFrame(animate);
    }
    animate();
    slider.addEventListener('mouseenter', () => {
        speed = 0;
    });
    slider.addEventListener('mouseleave', () => {
        speed = 0.5;
    });
    slider.addEventListener('mousedown', e => {
        isDragging = true;
        slider.classList.add('dragging');
        startX = e.pageX;
        startPosition = position;
    });
    window.addEventListener('mouseup', () => {
        isDragging = false;
        slider.classList.remove('dragging');
    });
    window.addEventListener('mousemove', e => {
        if (!isDragging) return;
        const distance = e.pageX - startX;
        position = startPosition + distance;
    });

});