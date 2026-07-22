const sections = document.querySelectorAll('.b-partnership');
if (sections.length > 0) {
  sections.forEach((section) => {
    const container = section.querySelector('.__timeline-container');
    const rows = section.querySelectorAll('.__timeline-row');
    const firstCircle = section.querySelector('.__timeline-circle');
    const progressBar = section.querySelector('.__timeline-progress-bar');

    if (!container || !rows.length || !firstCircle || !progressBar) return;

    // Funkcja obliczająca i ustawiająca idealną wysokość oraz położenie linii tła i postępu
    const rebuildTimeline = () => {
      const lastRow = rows[rows.length - 1];
      if (!lastRow) return;

      const circleCenter = firstCircle.offsetHeight / 2 || 30;
      const totalHeight = lastRow.offsetTop;

      // Zaktualizuj style pozycjonowania linii szyny oraz linii postępu
      const tracks = section.querySelectorAll('.__timeline-track, .__timeline-progress-track');
      tracks.forEach((track) => {
        track.style.top = `${circleCenter}px`;
        track.style.height = `${totalHeight}px`;
      });
    };

    // Uruchomienie początkowe przed ScrollTrigger.refresh()
    rebuildTimeline();

    // Dodanie nasłuchiwania na odświeżenie ScrollTrigger (np. przy resize okna)
    ScrollTrigger.addEventListener('refresh', rebuildTimeline);

    // Animacja głównej linii postępu (rysowanie się wraz z przewijaniem)
    gsap.fromTo(
      progressBar,
      { scaleY: 0 },
      {
        scaleY: 1,
        ease: 'none',
        scrollTrigger: {
          trigger: container,
          start: 'top 50%',
          end: 'bottom 60%',
          scrub: true,
          // markers: true,
        },
      }
    );

    // Animacja zapalania się kółek w miarę przejeżdżania linii
    rows.forEach((row) => {
      const circle = row.querySelector('.__timeline-circle');
      if (!circle) return;

      ScrollTrigger.create({
        trigger: row,
        start: 'top 50%',
        onEnter: () => {
          circle.classList.add('is-active');
        },
        onLeaveBack: () => {
          circle.classList.remove('is-active');
        },
      });
    });
  });
}
