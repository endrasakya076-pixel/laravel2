// portfolio.js - Highly Optimized Version
(function() {
    'use strict';

    // ======================
    // 1. CONFIGURATION & CACHE
    // ======================
    const CONFIG = {
        SCROLL_THRESHOLD: 50,
        DEBOUNCE_DELAY: 100,
        ANIMATION_DELAY: 150,
        NAVBAR_HEIGHT: 80
    };

    // Cache DOM elements
    const elements = {
        navbar: document.querySelector('.navbar'),
        contactForm: document.getElementById('contactForm'),
        fadeElements: document.querySelectorAll('.fade-in'),
        anchorLinks: document.querySelectorAll('a[href^="#"]')
    };

    // Performance variables
    let lastScrollY = window.scrollY;
    let scrollTimeout = null;
    let resizeTimeout = null;
    let observer = null;

    // ======================
    // 2. UTILITY FUNCTIONS
    // ======================
    const utils = {
        // Debounce function
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        // Throttle function
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },

        // Check if element is in viewport
        isInViewport: function(element, offset = 150) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) - offset
            );
        }
    };

    // ======================
    // 3. NAVBAR OPTIMIZATION
    // ======================
    function handleNavbarScroll() {
        const currentScrollY = window.scrollY;
        
        // Use requestAnimationFrame for smooth updates
        requestAnimationFrame(() => {
            if (currentScrollY > CONFIG.SCROLL_THRESHOLD) {
                elements.navbar.classList.add('navbar-scrolled');
            } else {
                elements.navbar.classList.remove('navbar-scrolled');
            }
        });
        
        lastScrollY = currentScrollY;
    }

    // Optimized scroll handler with throttling
    window.addEventListener('scroll', utils.throttle(handleNavbarScroll, CONFIG.DEBOUNCE_DELAY), { passive: true });

    // ======================
    // 4. SMOOTH SCROLLING - OPTIMIZED
    // ======================
    function initSmoothScroll() {
        elements.anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#' || targetId === '#!') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    
                    // Close mobile menu if open
                    closeMobileMenu();
                    
                    // Calculate target position
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - CONFIG.NAVBAR_HEIGHT;
                    
                    // Use native smooth scroll if available
                    if ('scrollBehavior' in document.documentElement.style) {
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    } else {
                        // Fallback for older browsers
                        smoothScrollFallback(targetPosition);
                    }
                }
            });
        });
    }

    function smoothScrollFallback(targetPosition) {
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        const duration = 800;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = easeInOutCubic(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function easeInOutCubic(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t * t + b;
            t -= 2;
            return c / 2 * (t * t * t + 2) + b;
        }

        requestAnimationFrame(animation);
    }

    function closeMobileMenu() {
        const navbarCollapse = document.querySelector('.navbar-collapse.show');
        if (navbarCollapse && window.innerWidth < 992) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    }

    // ======================
    // 5. FADE-IN ANIMATIONS - OPTIMIZED WITH INTERSECTION OBSERVER
    // ======================
    function initFadeAnimations() {
        // Use Intersection Observer if available (modern browsers)
        if ('IntersectionObserver' in window) {
            observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target); // Stop observing once visible
                    }
                });
            }, {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            });

            elements.fadeElements.forEach(el => {
                observer.observe(el);
            });
        } else {
            // Fallback for older browsers with throttled scroll
            const throttledFadeCheck = utils.throttle(checkFadeElements, CONFIG.DEBOUNCE_DELAY);
            window.addEventListener('scroll', throttledFadeCheck, { passive: true });
            checkFadeElements(); // Initial check
        }
    }

    function checkFadeElements() {
        elements.fadeElements.forEach(el => {
            if (!el.classList.contains('visible') && utils.isInViewport(el, 100)) {
                el.classList.add('visible');
            }
        });
    }

    // ======================
    // 6. FORM SUBMISSION - OPTIMIZED
    // ======================
    function initContactForm() {
        if (!elements.contactForm) return;
        
        elements.contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (!submitBtn) return;
            
            const originalText = submitBtn.innerHTML;
            
            // Simple validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                alert('Harap lengkapi semua field yang wajib diisi.');
                return;
            }
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengirim...';
            
            // Simulate async submission
            setTimeout(() => {
                alert('Pesan berhasil dikirim! Saya akan menghubungi Anda segera.');
                elements.contactForm.reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 1500);
        });
    }

    // ======================
    // 7. LAZY LOAD IMAGES
    // ======================
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');
            
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // ======================
    // 8. RESIZE OPTIMIZATION
    // ======================
    function handleResize() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Recalculate anything that depends on viewport size
            if (window.innerWidth >= 992) {
                closeMobileMenu();
            }
        }, CONFIG.DEBOUNCE_DELAY);
    }

    window.addEventListener('resize', utils.debounce(handleResize, CONFIG.DEBOUNCE_DELAY), { passive: true });

    // ======================
    // 9. INITIALIZATION
    // ======================
    function init() {
        // Initialize features
        initSmoothScroll();
        initFadeAnimations();
        initContactForm();
        initLazyLoading();
        
        // Set initial navbar state
        handleNavbarScroll();
        
        // Initialize Bootstrap tooltips if needed
        initTooltips();
        
        console.log('Portfolio optimized JS loaded');
    }

    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        if (tooltipElements.length > 0 && window.bootstrap && window.bootstrap.Tooltip) {
            tooltipElements.forEach(el => {
                new bootstrap.Tooltip(el, {
                    trigger: 'hover focus'
                });
            });
        }
    }

    // ======================
    // 10. CLEANUP
    // ======================
    function cleanup() {
        if (observer) {
            elements.fadeElements.forEach(el => observer.unobserve(el));
        }
    }

    // ======================
    // 11. EVENT LISTENERS
    // ======================
    // Wait for DOM and Bootstrap to load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', cleanup);

    // ======================
    // 12. CSRF TOKEN FOR AJAX (jQuery fallback)
    // ======================
    // Only initialize jQuery if it's loaded
    if (typeof jQuery !== 'undefined') {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                }
            });
        }
    }

})();