document.querySelectorAll('.js-logo-slider').forEach(slider => {
    let position = 0;
    let speed = 0.5;
    let isDragging = false;
    let startX = 0;
    let startPosition = 0;
    let transitionActive = false;
    let targetPosition = 0;

    const container = slider.parentElement;
    const prevBtn = container ? container.querySelector('.js-logo-prev') : null;
    const nextBtn = container ? container.querySelector('.js-logo-next') : null;
    const firstSlide = slider.querySelector('.__slide');

    const getStepSize = () => {
        const slideWidth = firstSlide ? firstSlide.offsetWidth : 320;
        const gap = parseFloat(window.getComputedStyle(slider).gap) || 60;
        return slideWidth + gap;
    };

    function animate() {
        if (isDragging) {
            targetPosition = position;
            transitionActive = false;
        } else if (transitionActive) {
            const diff = targetPosition - position;
            if (Math.abs(diff) < 0.5) {
                position = targetPosition;
                transitionActive = false;
            } else {
                position += diff * 0.1;
            }
        } else {
            position -= speed;
            targetPosition = position;
        }

        const halfWidth = slider.scrollWidth / 2;
        if (halfWidth > 0) {
            if (position <= -halfWidth) {
                position += halfWidth;
                targetPosition += halfWidth;
            } else if (position > 0) {
                position -= halfWidth;
                targetPosition -= halfWidth;
            }
        }

        slider.style.transform = `translateX(${position}px)`;
        requestAnimationFrame(animate);
    }
    animate();

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            targetPosition = targetPosition + getStepSize();
            transitionActive = true;
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            targetPosition = targetPosition - getStepSize();
            transitionActive = true;
        });
    }

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

    // --- OBSŁUGA DOTYKU (MOBILE) ---
    slider.addEventListener('touchstart', e => {
        isDragging = true;
        slider.classList.add('dragging');
        startX = e.touches[0].pageX;
        startPosition = position;
    }, { passive: true });

    window.addEventListener('touchend', () => {
        isDragging = false;
        slider.classList.remove('dragging');
    });

    window.addEventListener('touchmove', e => {
        if (!isDragging) return;
        const distance = e.touches[0].pageX - startX;
        position = startPosition + distance;
    }, { passive: true });

});