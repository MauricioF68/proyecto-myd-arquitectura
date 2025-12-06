document.addEventListener('DOMContentLoaded', () => {

    const animateCounter = (element, target) => {
        let current = 0;
        const duration = 2000; // 2 segundos
        const stepTime = Math.abs(Math.floor(duration / target));
        
        const timer = setInterval(() => {
            current += 1;
            element.innerText = current + '+';
            if (current === target) {
                clearInterval(timer);
            }
        }, stepTime);
    };

    const counters = [
        { id: 'counter1', triggered: false },
        { id: 'counter2', triggered: false }
    ];

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counterInfo = counters.find(c => c.id === entry.target.id);
                if (counterInfo && !counterInfo.triggered) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    animateCounter(entry.target, target);
                    counterInfo.triggered = true; // Evita que se dispare de nuevo
                    observer.unobserve(entry.target); // Deja de observar este elemento
                }
            }
        });
    }, {
        threshold: 0.5 // Se activa cuando el 50% del elemento es visible
    });

    counters.forEach(counter => {
        const el = document.getElementById(counter.id);
        if (el) {
            observer.observe(el);
        }
    });

});