document.addEventListener('DOMContentLoaded', function() {
    const heroContent = document.querySelector('.hero-content');
    const heroImage = document.querySelector('.hero-image-container');
    const heroText = document.querySelector('.hero-text-container');
    const callToAction = document.querySelector('.btn-primary');

    // Animación de la sección principal
    function checkHeroVisibility() {
        if (!heroContent) return;
        const rect = heroContent.getBoundingClientRect();
        const isVisible = rect.top < window.innerHeight - 100;
        if (isVisible) {
            heroContent.classList.add('animate');
            heroImage.classList.add('animate');
            heroText.classList.add('animate');
            callToAction.classList.add('animate');
            window.removeEventListener('scroll', checkHeroVisibility);
        }
    }
    window.addEventListener('scroll', checkHeroVisibility);
    checkHeroVisibility();

    // Animación del grid de servicios
    const serviceCards = document.querySelectorAll('.service-card');
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.3
    };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, options);
    serviceCards.forEach(card => {
        observer.observe(card);
    });
});