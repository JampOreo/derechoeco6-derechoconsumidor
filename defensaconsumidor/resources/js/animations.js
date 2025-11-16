// Animaciones avanzadas para la página
class ScrollAnimations {
    constructor() {
        this.observer = null;
        this.init();
    }

    init() {
        this.setupIntersectionObserver();
        this.setupScrollEffects();
    }

    setupIntersectionObserver() {
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observar elementos con animación
        document.querySelectorAll('.section').forEach(section => {
            this.observer.observe(section);
        });
    }

    setupScrollEffects() {
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const summaryWrapper = document.querySelector('.summary-wrapper');
            
            if (summaryWrapper) {
                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    summaryWrapper.style.transform = 'translateY(0)';
                } else {
                    // Scrolling up
                    summaryWrapper.style.transform = 'translateY(0)';
                }
            }
            
            lastScrollTop = scrollTop;
        });
    }
}

// Efectos de hover mejorados
class HoverEffects {
    constructor() {
        this.init();
    }

    init() {
        this.setupCardHovers();
        this.setupButtonHovers();
    }

    setupCardHovers() {
        const cards = document.querySelectorAll('.action-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transition = 'all 0.3s ease';
            });
        });
    }

    setupButtonHovers() {
        const buttons = document.querySelectorAll('.summary-toggle-btn, .back-to-top-btn');
        
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.transform = 'translateY(-2px) scale(1.02)';
            });
            
            button.addEventListener('mouseleave', () => {
                button.style.transform = 'translateY(0) scale(1)';
            });
        });
    }
}

// Efectos de carga de página
class PageLoadEffects {
    constructor() {
        this.init();
    }

    init() {
        this.animateHeroElements();
        this.setupStaggeredAnimations();
    }

    animateHeroElements() {
        const heroTitle = document.querySelector('.hero h1');
        const heroText = document.querySelector('.hero p');
        
        if (heroTitle) {
            setTimeout(() => {
                heroTitle.style.animation = 'pulse 2s ease-in-out infinite';
            }, 2000);
        }
    }

    setupStaggeredAnimations() {
        const summaryItems = document.querySelectorAll('.summary-list li');
        
        summaryItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.05}s`;
        });
    }
}

// Inicializar todas las animaciones cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new ScrollAnimations();
    new HoverEffects();
    new PageLoadEffects();
});

// Efecto de partículas para el hero (opcional)
function createParticles() {
    const hero = document.querySelector('.hero');
    if (!hero) return;

    for (let i = 0; i < 15; i++) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            top: ${Math.random() * 100}%;
            left: ${Math.random() * 100}%;
            animation: float 6s ease-in-out infinite;
            animation-delay: ${Math.random() * 6}s;
        `;
        hero.appendChild(particle);
    }

    // Agregar la animación flotante
    const style = document.createElement('style');
    style.textContent = `
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            50% { transform: translateY(-20px) translateX(10px); opacity: 0.7; }
        }
    `;
    document.head.appendChild(style);
}

// Llamar a la función de partículas
createParticles();