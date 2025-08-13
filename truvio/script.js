// Mobile Navigation Toggle
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
    hamburger.classList.remove('active');
    navMenu.classList.remove('active');
}));

// Navbar background on scroll
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.style.background = 'rgba(255, 255, 255, 0.98)';
        navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    } else {
        navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        navbar.style.boxShadow = 'none';
    }
});

// Smooth scrolling for anchor links
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
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in-up');
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animateElements = document.querySelectorAll('.service-card, .feature, .product-card, .testimonial-card, .about-text, .about-image');
    animateElements.forEach(el => observer.observe(el));
});

// Active navigation link highlighting
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= (sectionTop - 200)) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// Form validation and submission (for contact forms)
const contactForm = document.querySelector('#contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic form validation
        const name = this.querySelector('#name').value.trim();
        const email = this.querySelector('#email').value.trim();
        const message = this.querySelector('#message').value.trim();
        
        if (!name || !email || !message) {
            showNotification('Please fill in all fields', 'error');
            return;
        }
        
        if (!isValidEmail(email)) {
            showNotification('Please enter a valid email address', 'error');
            return;
        }
        
        // Simulate form submission
        showNotification('Thank you! We will get back to you soon.', 'success');
        this.reset();
    });
}

// Email validation helper
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (document.body.contains(notification)) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }
    }, 5000);
}

// Lazy loading for images (if any are added later)
const lazyImages = document.querySelectorAll('img[data-src]');
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.remove('lazy');
            imageObserver.unobserve(img);
        }
    });
});

lazyImages.forEach(img => imageObserver.observe(img));

// Search functionality for categories page
const searchInput = document.querySelector('#search-input');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            const productName = card.querySelector('h3').textContent.toLowerCase();
            const productDesc = card.querySelector('p').textContent.toLowerCase();
            const category = card.querySelector('.category').textContent.toLowerCase();
            
            if (productName.includes(searchTerm) || 
                productDesc.includes(searchTerm) || 
                category.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
}

// Product selection functionality for categories page
let selectedProducts = [];

function addToSelection(productId, productName, productPrice) {
    if (!selectedProducts.find(p => p.id === productId)) {
        selectedProducts.push({ id: productId, name: productName, price: productPrice });
        updateSelectionSidebar();
        showNotification(`${productName} added to selection`, 'success');
    } else {
        showNotification(`${productName} is already in your selection`, 'info');
    }
}

function removeFromSelection(productId) {
    selectedProducts = selectedProducts.filter(p => p.id !== productId);
    updateSelectionSidebar();
}

function updateSelectionSidebar() {
    const sidebar = document.querySelector('.selection-sidebar');
    if (sidebar) {
        const productList = sidebar.querySelector('.selected-products-list');
        productList.innerHTML = '';
        
        selectedProducts.forEach(product => {
            const productItem = document.createElement('div');
            productItem.className = 'selected-product-item';
            productItem.innerHTML = `
                <span>${product.name}</span>
                <button onclick="removeFromSelection('${product.id}')" class="remove-btn">&times;</button>
            `;
            productList.appendChild(productItem);
        });
        
        // Update total
        const total = selectedProducts.reduce((sum, product) => sum + product.price, 0);
        sidebar.querySelector('.selection-total').textContent = `Total: ₹${total.toLocaleString()}`;
    }
}

// Initialize tooltips for product cards
document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Back to top button
const backToTopBtn = document.createElement('button');
backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
backToTopBtn.className = 'back-to-top';
backToTopBtn.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
    z-index: 1000;
`;

document.body.appendChild(backToTopBtn);

backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopBtn.style.display = 'flex';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

// Performance optimization: Debounce scroll events
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Apply debouncing to scroll events
const debouncedScrollHandler = debounce(() => {
    // Scroll-based animations and effects
}, 10);

window.addEventListener('scroll', debouncedScrollHandler);

// Additional functions for categories page
function clearSelection() {
    selectedProducts = [];
    updateSelectionSidebar();
    showNotification('Selection cleared', 'info');
}

function requestQuote() {
    if (selectedProducts.length === 0) {
        showNotification('Please add products to your selection first', 'error');
        return;
    }
    
    const total = selectedProducts.reduce((sum, product) => sum + product.price, 0);
    const productList = selectedProducts.map(p => p.name).join(', ');
    
    // Redirect to contact page with pre-filled form
    const message = `I would like a quote for the following products:\n\n${productList}\n\nTotal estimated value: ₹${total.toLocaleString()}`;
    const encodedMessage = encodeURIComponent(message);
    
    window.location.href = `contact.html?message=${encodedMessage}`;
}

// Filter functionality
const categoryFilter = document.querySelector('#category-filter');
const priceFilter = document.querySelector('#price-filter');

if (categoryFilter) {
    categoryFilter.addEventListener('change', filterProducts);
}

if (priceFilter) {
    priceFilter.addEventListener('change', filterProducts);
}

function filterProducts() {
    const categoryValue = categoryFilter.value;
    const priceValue = priceFilter.value;
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        const category = card.dataset.category;
        const price = parseInt(card.dataset.price);
        
        let showCard = true;
        
        // Category filter
        if (categoryValue && category !== categoryValue) {
            showCard = false;
        }
        
        // Price filter
        if (priceValue && showCard) {
            const [min, max] = priceValue.split('-').map(p => p === '+' ? Infinity : parseInt(p));
            if (price < min || (max !== Infinity && price > max)) {
                showCard = false;
            }
        }
        
        card.style.display = showCard ? 'block' : 'none';
    });
}

// FAQ functionality
document.addEventListener('DOMContentLoaded', () => {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            
            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
});

// Pre-fill contact form if coming from categories page
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    
    if (message && document.getElementById('message')) {
        document.getElementById('message').value = decodeURIComponent(message);
    }
});

// Enhanced search with auto-suggestions
const searchInput = document.querySelector('#search-input');
if (searchInput) {
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = this.value.toLowerCase();
        
        searchTimeout = setTimeout(() => {
            const productCards = document.querySelectorAll('.product-card');
            let visibleCount = 0;
            
            productCards.forEach(card => {
                const productName = card.querySelector('h3').textContent.toLowerCase();
                const productDesc = card.querySelector('p').textContent.toLowerCase();
                const category = card.querySelector('.category').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || 
                    productDesc.includes(searchTerm) || 
                    category.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show results count
            const resultsInfo = document.querySelector('.search-results-info');
            if (!resultsInfo) {
                const info = document.createElement('div');
                info.className = 'search-results-info';
                info.style.cssText = 'text-align: center; margin: 1rem 0; color: #6b7280;';
                searchInput.parentElement.parentElement.appendChild(info);
            }
            
            if (resultsInfo) {
                resultsInfo.textContent = `${visibleCount} products found`;
            }
        }, 300);
    });
}
