jQuery(document).ready(function($) {
    // Smooth scrolling for navigation links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });

    // Navbar background on scroll
    $(window).on('scroll', function() {
        const navbar = $('.navbar');
        if ($(window).scrollTop() > 50) {
            navbar.css({
                'background': 'rgba(255, 255, 255, 0.98)',
                'box-shadow': '0 2px 20px rgba(0, 0, 0, 0.1)'
            });
        } else {
            navbar.css({
                'background': 'rgba(255, 255, 255, 0.95)',
                'box-shadow': 'none'
            });
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    $('.fade-in, .slide-in-left, .slide-in-right').each(function() {
        observer.observe(this);
    });

    // Counter animation for stats
    function animateCounters() {
        $('.stat-number').each(function() {
            const $this = $(this);
            const target = parseInt($this.text());
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    $this.text(Math.ceil(current) + ($this.text().includes('+') ? '+' : '') + ($this.text().includes('%') ? '%' : ''));
                    setTimeout(updateCounter, 20);
                } else {
                    $this.text(target + ($this.text().includes('+') ? '+' : '') + ($this.text().includes('%') ? '%' : ''));
                }
            };
            
            updateCounter();
        });
    }

    // Trigger counter animation when stats section is visible
    const statsSection = $('.stats-grid');
    if (statsSection.length) {
        const statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statsObserver.observe(statsSection[0]);
    }

    // Add active class to navigation items based on scroll position
    $(window).on('scroll', function() {
        const scrollDistance = $(window).scrollTop() + 100;
        
        $('section[id]').each(function(i) {
            if ($(this).position().top <= scrollDistance) {
                $('.navbar-nav .nav-link.active').removeClass('active');
                $('.navbar-nav .nav-link').each(function() {
                    if ($(this).attr('href') === '#' + $(this).closest('section').attr('id')) {
                        $(this).addClass('active');
                    }
                });
            }
        });
    });

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Add loading animation for page transitions
    $(window).on('beforeunload', function() {
        $('body').addClass('loading');
    });

    // Remove loading class when page is fully loaded
    $(window).on('load', function() {
        $('body').removeClass('loading');
    });

    // Add hover effects for service cards
    $('.service-card').on('mouseenter', function() {
        $(this).addClass('hovered');
    }).on('mouseleave', function() {
        $(this).removeClass('hovered');
    });

    // Add click effects for timeline cards
    $('.timeline-card').on('click', function() {
        $(this).addClass('clicked');
        setTimeout(() => {
            $(this).removeClass('clicked');
        }, 300);
    });

    // Parallax effect for hero section
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        const parallax = $('.hero-section');
        const speed = 0.5;
        
        if (parallax.length) {
            parallax.css('transform', 'translateY(' + (scrolled * speed) + 'px)');
        }
    });

    // Add typing effect for hero title (optional)
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.html('');
        
        function type() {
            if (i < text.length) {
                element.html(element.html() + text.charAt(i));
                i++;
                setTimeout(type, speed);
            }
        }
        type();
    }

    // Initialize typing effect if element exists
    const heroTitle = $('.hero-title');
    if (heroTitle.length && !heroTitle.hasClass('typed')) {
        const originalText = heroTitle.text();
        heroTitle.addClass('typed');
        typeWriter(heroTitle, originalText, 50);
    }

    // Add scroll to top button
    const scrollTopBtn = $('<button class="scroll-top-btn" title="Scroll to top"><i class="bi bi-arrow-up"></i></button>');
    $('body').append(scrollTopBtn);

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 300) {
            scrollTopBtn.addClass('show');
        } else {
            scrollTopBtn.removeClass('show');
        }
    });

    scrollTopBtn.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    // Add CSS for scroll to top button
    const scrollTopCSS = `
        <style>
            .scroll-top-btn {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                background: var(--primary-color);
                color: white;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            }
            
            .scroll-top-btn.show {
                opacity: 1;
                visibility: visible;
            }
            
            .scroll-top-btn:hover {
                background: var(--secondary-color);
                transform: translateY(-2px);
            }
            
            .loading {
                overflow: hidden;
            }
            
            .service-card.hovered {
                transform: translateY(-15px) scale(1.05);
            }
            
            .timeline-card.clicked {
                transform: scale(0.95);
            }
        </style>
    `;
    
    $('head').append(scrollTopCSS);
}); 