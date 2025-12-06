document.addEventListener('DOMContentLoaded', function() {


    

    // --- Lógica del Menú Móvil (Hamburguesa) ---
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('is-active');
            navToggle.classList.toggle('is-active');
        });
    }

    // --- LÓGICA PARA EL MODAL DE BIENVENIDA (CORREGIDA) ---
    const modal = document.getElementById('welcomeModal');

    // Si el modal existe en la página (porque la variable de sesión estaba activa)...
    if (modal) {
        const closeButton = modal.querySelector('.modal-close');

        const showModal = () => {
            modal.classList.add('is-visible');
        };
        const hideModal = () => {
            modal.classList.remove('is-visible');
        };

        // ✅ ¡AQUÍ ESTÁ LA PARTE CLAVE! Le damos la orden de mostrarse.
        showModal();

        // Asignamos los eventos para poder cerrarlo
        if (closeButton) {
            closeButton.addEventListener('click', hideModal);
        }
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                hideModal();
            }
        });
    }
    
    // --- Lógica para el contador animado ---
    const counters = document.querySelectorAll('.counter-item span');
    if (counters.length > 0) {
        const observerCounters = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const finalValue = parseInt(target.dataset.target);
                    let currentValue = 0;
                    const duration = 2000;
                    const stepTime = 10;
                    const increment = (finalValue / (duration / stepTime));

                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            currentValue = finalValue;
                            clearInterval(timer);
                        }
                        target.textContent = Math.ceil(currentValue) + '+'; // Añadimos el '+'
                    }, stepTime);
                    observer.unobserve(target);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(counter => observerCounters.observe(counter));
    }

    


    // --- Lógica para el carrusel de proyectos ---
    const carouselContainer = document.querySelector('.project-carousel-container');
    if (carouselContainer) {
        const track = carouselContainer.querySelector('.project-carousel-track');
        const slides = Array.from(track.children);
        const prevBtn = carouselContainer.querySelector('#prevBtn');
        const nextBtn = carouselContainer.querySelector('#nextBtn');

        if (slides.length > 1) { // Solo activar el carrusel si hay más de 1 slide
            slides.forEach(slide => {
                const clone = slide.cloneNode(true);
                clone.classList.add('clone');
                track.appendChild(clone);
            });

            let currentIndex = 0;
            let slideInterval;
            const slideWidth = slides[0].getBoundingClientRect().width;

            const moveToSlide = (index) => {
                track.style.transition = 'transform 0.6s ease-in-out';
                track.style.transform = `translateX(-${slideWidth * index}px)`;
            };

            const nextSlide = () => {
                currentIndex++;
                moveToSlide(currentIndex);
                if (currentIndex === slides.length) {
                    setTimeout(() => {
                        track.style.transition = 'none';
                        currentIndex = 0;
                        track.style.transform = `translateX(0)`;
                    }, 600);
                }
            };
            
            const prevSlide = () => {
                if (currentIndex === 0) {
                    track.style.transition = 'none';
                    currentIndex = slides.length;
                    track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
                    setTimeout(() => {
                        currentIndex--;
                        moveToSlide(currentIndex);
                    }, 50);
                } else {
                    currentIndex--;
                    moveToSlide(currentIndex);
                }
            };

            const startCarousel = () => {
                slideInterval = setInterval(nextSlide, 5000);
            };

            const stopCarousel = () => {
                clearInterval(slideInterval);
            };

            startCarousel();
            carouselContainer.addEventListener('mouseenter', stopCarousel);
            carouselContainer.addEventListener('mouseleave', startCarousel);
            
            nextBtn.addEventListener('click', () => {
                stopCarousel();
                nextSlide();
                startCarousel();
            });
            
            prevBtn.addEventListener('click', () => {
                stopCarousel();
                prevSlide();
                startCarousel();
            });
        }
    }

    // --- Lógica para la animación de scroll ---
    const fadeElements = document.querySelectorAll('.fade-in-scroll');
    if(fadeElements.length > 0) {
        const observerFade = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });
        fadeElements.forEach(element => observerFade.observe(element));
    }


    // --- Lógica para el carrusel de logos ---
    const logosContainer = document.querySelector('.logos-carousel-container');
    if (logosContainer) {
        const track = logosContainer.querySelector('.logos-carousel-track');
        const slides = Array.from(track.children);
        const prevBtn = logosContainer.querySelector('#prevLogos');
        const nextBtn = logosContainer.querySelector('#nextLogos');

        let currentIndex = 0;
        let slideInterval;
        const slideWidth = slides[0].getBoundingClientRect().width;

        const moveToSlide = (index) => {
            track.style.transition = 'transform 0.6s ease-in-out';
            track.style.transform = `translateX(-${slideWidth * index}px)`;
        };

        const nextSlide = () => {
            currentIndex++;
            if (currentIndex >= slides.length) {
                currentIndex = 0;
            }
            moveToSlide(currentIndex);
        };

        const prevSlide = () => {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = slides.length - 1,5;
            }
            moveToSlide(currentIndex);
        };

        const startCarousel = () => {
            slideInterval = setInterval(nextSlide, 4000);
        };

        const stopCarousel = () => {
            clearInterval(slideInterval);
        };

        startCarousel();
        logosContainer.addEventListener('mouseenter', stopCarousel);
        logosContainer.addEventListener('mouseleave', startCarousel);

        nextBtn.addEventListener('click', () => {
            stopCarousel();
            nextSlide();
            startCarousel();
        });

        prevBtn.addEventListener('click', () => {
            stopCarousel();
            prevSlide();
            startCarousel();
        });
    }   

    
});