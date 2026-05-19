document.addEventListener('DOMContentLoaded', () => {
    
    // Opcje dla Intersection Observera
    const observerOptions = {
        root: null, // Obserwujemy cały viewport (okno przeglądarki)
        rootMargin: '0px',
        threshold: 0.15 // Animacja uruchamia się, gdy 15% elementu staje się widoczne
    };

    // Tworzymy obserwatora
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // Jeśli element jest na ekranie
            if (entry.isIntersecting) {
                // Dodajemy klasę aktywującą animację z CSS
                entry.target.classList.add('show-anim');
                
                // Przestajemy obserwować element, by animacja odtworzyła się tylko raz
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Znajdujemy wszystkie elementy z klasą .hidden-anim
    const elementsToAnimate = document.querySelectorAll('.hidden-anim');

    // Przekazujemy każdy element do obserwatora
    elementsToAnimate.forEach(el => {
        observer.observe(el);
    });

});