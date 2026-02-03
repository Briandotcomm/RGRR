// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile menu toggle
const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
const navLinks = document.querySelector('.nav-links');

mobileMenuToggle?.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    mobileMenuToggle.classList.toggle('active');
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Intersection Observer for fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Apply fade-in to feature cards and pricing cards
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.feature-card, .pricing-card');
    
    animatedElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });
});

// Parallax effect for hero background
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroWaves = document.querySelectorAll('.wave');
    
    heroWaves.forEach((wave, index) => {
        const speed = 0.5 + (index * 0.2);
        wave.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// Add hover effect to cube
const cube = document.querySelector('.cube');
let isHovering = false;

if (cube) {
    cube.addEventListener('mouseenter', () => {
        isHovering = true;
        cube.style.animationPlayState = 'paused';
    });

    cube.addEventListener('mouseleave', () => {
        isHovering = false;
        cube.style.animationPlayState = 'running';
    });

    cube.addEventListener('mousemove', (e) => {
        if (!isHovering) return;
        
        const rect = cube.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        
        const rotateX = (y / rect.height) * 30;
        const rotateY = (x / rect.width) * 30;
        
        cube.style.transform = `rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
    });
}

// Button click animations
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add ripple effect styles dynamically
const style = document.createElement('style');
style.textContent = `
    button {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .nav-links.active {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(15, 76, 66, 0.95);
        backdrop-filter: blur(10px);
        padding: 20px;
        gap: 20px;
        border-bottom: 1px solid rgba(74, 222, 128, 0.2);
    }
    
    .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }
    
    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }
`;
document.head.appendChild(style);

// Add cursor glow effect
const cursorGlow = document.createElement('div');
cursorGlow.className = 'cursor-glow';
document.body.appendChild(cursorGlow);

const glowStyle = document.createElement('style');
glowStyle.textContent = `
    .cursor-glow {
        position: fixed;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(74, 222, 128, 0.15), transparent 70%);
        pointer-events: none;
        transform: translate(-50%, -50%);
        transition: opacity 0.3s ease;
        opacity: 0;
        z-index: 9999;
    }
`;
document.head.appendChild(glowStyle);

document.addEventListener('mousemove', (e) => {
    cursorGlow.style.left = e.clientX + 'px';
    cursorGlow.style.top = e.clientY + 'px';
    cursorGlow.style.opacity = '1';
});

document.addEventListener('mouseleave', () => {
    cursorGlow.style.opacity = '0';
});

// Counter animation for pricing
const animateCounter = (element, target, duration) => {
    let current = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
};

// Observe pricing cards and animate numbers
const pricingObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const amount = entry.target.querySelector('.amount');
            if (amount && !isNaN(amount.textContent)) {
                const target = parseInt(amount.textContent);
                amount.textContent = '0';
                animateCounter(amount, target, 1000);
                pricingObserver.unobserve(entry.target);
            }
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.pricing-card').forEach(card => {
    pricingObserver.observe(card);s
});

// Add loading animation
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
});

console.log('🚀 RGRR WebMaker - Ready to build amazing websites!');