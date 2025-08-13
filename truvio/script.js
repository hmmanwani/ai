// Global variables
let selectedProducts = [];
const allProducts = [
    // Electrical
    { name: 'LED Panel Lights', category: 'electrical' },
    { name: 'Cable Management', category: 'electrical' },
    { name: 'Smart Switches', category: 'electrical' },
    { name: 'Distribution Panels', category: 'electrical' },
    
    // Surfaces
    { name: 'HPL Panels', category: 'surfaces' },
    { name: 'Stone Cladding', category: 'surfaces' },
    { name: 'Metal Panels', category: 'surfaces' },
    { name: 'Wood Veneer', category: 'surfaces' },
    
    // Finishes
    { name: 'Exterior Paint', category: 'finishes' },
    { name: 'Interior Emulsion', category: 'finishes' },
    { name: 'Textured Coating', category: 'finishes' },
    { name: 'Primer Solutions', category: 'finishes' },
    
    // Flooring
    { name: 'Vitrified Tiles', category: 'flooring' },
    { name: 'Wooden Flooring', category: 'flooring' },
    { name: 'Vinyl Flooring', category: 'flooring' },
    { name: 'Epoxy Flooring', category: 'flooring' },
    
    // Ceiling
    { name: 'Suspended Ceiling', category: 'ceiling' },
    { name: 'Gypsum Boards', category: 'ceiling' },
    { name: 'Metal Ceiling', category: 'ceiling' },
    { name: 'PVC Ceiling', category: 'ceiling' },
    
    // Wood
    { name: 'Plywood Sheets', category: 'wood' },
    { name: 'MDF Boards', category: 'wood' },
    { name: 'Timber Logs', category: 'wood' },
    { name: 'Laminated Wood', category: 'wood' },
    
    // Hardware
    { name: 'Door Hardware', category: 'hardware' },
    { name: 'Window Fittings', category: 'hardware' },
    { name: 'Fasteners', category: 'hardware' },
    { name: 'Cabinet Hardware', category: 'hardware' }
];

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeNavigation();
    initializeSearch();
    loadSelectedProducts();
    
    // Initialize animations
    initializeAnimations();
});

// Navigation functionality
function initializeNavigation() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        // Close menu when clicking on nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });
    }
}

// Search functionality
function initializeSearch() {
    const searchInput = document.getElementById('productSearch');
    const searchSuggestions = document.getElementById('searchSuggestions');
    
    if (searchInput && searchSuggestions) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim().toLowerCase();
            
            if (query.length === 0) {
                hideSuggestions();
                clearSearchResults();
                return;
            }
            
            searchTimeout = setTimeout(() => {
                showSuggestions(query);
                performSearch(query);
            }, 300);
        });
        
        searchInput.addEventListener('focus', function() {
            const query = this.value.trim().toLowerCase();
            if (query.length > 0) {
                showSuggestions(query);
            }
        });
        
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                hideSuggestions();
            }
        });
    }
}

function showSuggestions(query) {
    const searchSuggestions = document.getElementById('searchSuggestions');
    if (!searchSuggestions) return;
    
    const matches = allProducts.filter(product => 
        product.name.toLowerCase().includes(query) || 
        product.category.toLowerCase().includes(query)
    ).slice(0, 5);
    
    if (matches.length === 0) {
        hideSuggestions();
        return;
    }
    
    searchSuggestions.innerHTML = matches.map(product => 
        `<div class="suggestion-item" onclick="selectSuggestion('${product.name}')">
            <strong>${highlightMatch(product.name, query)}</strong>
            <small style="color: var(--text-muted); display: block; text-transform: capitalize;">${product.category}</small>
        </div>`
    ).join('');
    
    searchSuggestions.style.display = 'block';
}

function hideSuggestions() {
    const searchSuggestions = document.getElementById('searchSuggestions');
    if (searchSuggestions) {
        searchSuggestions.style.display = 'none';
    }
}

function selectSuggestion(productName) {
    const searchInput = document.getElementById('productSearch');
    if (searchInput) {
        searchInput.value = productName;
        hideSuggestions();
        performSearch(productName.toLowerCase());
    }
}

function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<mark style="background: var(--primary-color); color: var(--primary-bg); padding: 1px 3px; border-radius: 2px;">$1</mark>');
}

function performSearch(query) {
    // Clear previous search results
    clearSearchResults();
    
    const matches = allProducts.filter(product => 
        product.name.toLowerCase().includes(query) || 
        product.category.toLowerCase().includes(query)
    );
    
    if (matches.length === 0) {
        showNoResults(query);
        return;
    }
    
    // Show search results
    showSearchResults(matches, query);
    
    // Highlight matching products
    highlightProducts(matches);
}

function showSearchResults(matches, query) {
    const categoriesContent = document.querySelector('.categories-content');
    const categoryOverview = document.querySelector('.category-overview');
    
    if (!categoriesContent || !categoryOverview) return;
    
    const searchResultsHtml = `
        <div class="search-results">
            <h3>Search Results for "${query}"</h3>
            <p class="search-results-count">${matches.length} product${matches.length !== 1 ? 's' : ''} found</p>
        </div>
    `;
    
    categoryOverview.insertAdjacentHTML('afterend', searchResultsHtml);
}

function showNoResults(query) {
    const categoriesContent = document.querySelector('.categories-content');
    const categoryOverview = document.querySelector('.category-overview');
    
    if (!categoriesContent || !categoryOverview) return;
    
    const noResultsHtml = `
        <div class="search-results">
            <h3>No Results Found</h3>
            <p class="search-results-count">No products found for "${query}". Try different keywords or browse categories below.</p>
        </div>
    `;
    
    categoryOverview.insertAdjacentHTML('afterend', noResultsHtml);
}

function clearSearchResults() {
    const searchResults = document.querySelector('.search-results');
    if (searchResults) {
        searchResults.remove();
    }
    
    // Remove highlights
    document.querySelectorAll('.highlighted').forEach(el => {
        el.classList.remove('highlighted');
    });
}

function highlightProducts(matches) {
    matches.forEach(match => {
        const productCard = document.querySelector(`[data-product="${match.name}"]`);
        if (productCard) {
            productCard.classList.add('highlighted');
            productCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
}

function clearSearch() {
    const searchInput = document.getElementById('productSearch');
    if (searchInput) {
        searchInput.value = '';
        hideSuggestions();
        clearSearchResults();
    }
}

// Product selection functionality
function addProduct(productName, category) {
    // Check if product is already selected
    const existingProduct = selectedProducts.find(p => p.name === productName);
    if (existingProduct) {
        showNotification(`${productName} is already in your list!`, 'warning');
        return;
    }
    
    // Add product to selected list
    selectedProducts.push({
        name: productName,
        category: category,
        id: Date.now() + Math.random()
    });
    
    // Update UI
    updateSelectedProductsList();
    updateSidebarState();
    
    // Visual feedback
    const button = document.querySelector(`[data-product="${productName}"] .add-product-btn`);
    if (button) {
        button.classList.add('added');
        button.innerHTML = '<i class="fas fa-check"></i>';
        
        setTimeout(() => {
            button.classList.remove('added');
            button.innerHTML = '<i class="fas fa-plus"></i>';
        }, 1000);
    }
    
    // Save to localStorage
    saveSelectedProducts();
    
    showNotification(`${productName} added to your selection!`, 'success');
}

function removeProduct(productId) {
    const productIndex = selectedProducts.findIndex(p => p.id === productId);
    if (productIndex > -1) {
        const productName = selectedProducts[productIndex].name;
        selectedProducts.splice(productIndex, 1);
        
        updateSelectedProductsList();
        updateSidebarState();
        saveSelectedProducts();
        
        showNotification(`${productName} removed from your selection!`, 'info');
    }
}

function clearAllProducts() {
    if (selectedProducts.length === 0) return;
    
    if (confirm('Are you sure you want to clear all selected products?')) {
        selectedProducts = [];
        updateSelectedProductsList();
        updateSidebarState();
        saveSelectedProducts();
        
        showNotification('All products cleared!', 'info');
    }
}

function updateSelectedProductsList() {
    const productsList = document.getElementById('selectedProductsList');
    if (!productsList) return;
    
    if (selectedProducts.length === 0) {
        productsList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-shopping-cart"></i>
                <p>No products selected yet</p>
                <small>Add products from categories to see them here</small>
            </div>
        `;
        return;
    }
    
    productsList.innerHTML = selectedProducts.map(product => `
        <div class="selected-product-item">
            <div class="selected-product-info">
                <h5>${product.name}</h5>
                <span>${product.category}</span>
            </div>
            <button class="remove-product-btn" onclick="removeProduct(${product.id})">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `).join('');
}

function updateSidebarState() {
    const productCount = document.getElementById('productCount');
    const clearAllBtn = document.querySelector('.clear-all-btn');
    const getQuoteBtn = document.querySelector('.get-quote-btn');
    
    if (productCount) {
        productCount.textContent = `${selectedProducts.length} item${selectedProducts.length !== 1 ? 's' : ''}`;
    }
    
    if (clearAllBtn && getQuoteBtn) {
        if (selectedProducts.length > 0) {
            clearAllBtn.disabled = false;
            getQuoteBtn.disabled = false;
        } else {
            clearAllBtn.disabled = true;
            getQuoteBtn.disabled = true;
        }
    }
}

function getQuote() {
    if (selectedProducts.length === 0) {
        showNotification('Please select at least one product to get a quote!', 'warning');
        return;
    }
    
    // Create quote data
    const quoteData = {
        products: selectedProducts,
        timestamp: new Date().toISOString(),
        userAgent: navigator.userAgent
    };
    
    // Store quote data
    localStorage.setItem('truvio_quote_request', JSON.stringify(quoteData));
    
    // Redirect to contact page
    window.location.href = 'contact.html';
}

// Local storage functions
function saveSelectedProducts() {
    localStorage.setItem('truvio_selected_products', JSON.stringify(selectedProducts));
}

function loadSelectedProducts() {
    const saved = localStorage.getItem('truvio_selected_products');
    if (saved) {
        try {
            selectedProducts = JSON.parse(saved);
            updateSelectedProductsList();
            updateSidebarState();
        } catch (e) {
            console.error('Error loading selected products:', e);
        }
    }
}

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${getNotificationIcon(type)}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 90px;
        right: 20px;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: var(--spacing-sm) var(--spacing-md);
        box-shadow: var(--shadow-lg);
        z-index: 10000;
        transform: translateX(400px);
        transition: transform 0.3s ease;
        max-width: 300px;
    `;
    
    // Type-specific styling
    if (type === 'success') {
        notification.style.borderLeftColor = '#10b981';
    } else if (type === 'warning') {
        notification.style.borderLeftColor = '#f59e0b';
    } else if (type === 'error') {
        notification.style.borderLeftColor = '#ef4444';
    } else {
        notification.style.borderLeftColor = 'var(--primary-color)';
    }
    
    notification.style.borderLeftWidth = '4px';
    
    // Add to page
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}

function getNotificationIcon(type) {
    switch (type) {
        case 'success': return 'fa-check-circle';
        case 'warning': return 'fa-exclamation-triangle';
        case 'error': return 'fa-times-circle';
        default: return 'fa-info-circle';
    }
}

// Animation initialization
function initializeAnimations() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.querySelectorAll('.service-card, .benefit-card, .product-card, .team-member, .value-card').forEach(el => {
        observer.observe(el);
    });
}

// Contact form handling (for contact page)
function handleContactForm() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        // Check if there's a quote request
        const quoteRequest = localStorage.getItem('truvio_quote_request');
        if (quoteRequest) {
            data.quoteRequest = JSON.parse(quoteRequest);
        }
        
        // Simulate form submission
        showNotification('Thank you! Your message has been sent. We will get back to you soon.', 'success');
        
        // Clear form
        this.reset();
        
        // Clear quote request
        localStorage.removeItem('truvio_quote_request');
        
        console.log('Form data:', data);
    });
}

// Initialize contact form when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', handleContactForm);
} else {
    handleContactForm();
}

// Smooth scrolling for anchor links
document.addEventListener('click', function(e) {
    const link = e.target.closest('a[href^="#"]');
    if (link) {
        e.preventDefault();
        const targetId = link.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
});

// Scroll to top functionality
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Add scroll to top button
function addScrollToTopButton() {
    const scrollToTopBtn = document.createElement('button');
    scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    scrollToTopBtn.className = 'scroll-to-top';
    scrollToTopBtn.onclick = scrollToTop;
    
    scrollToTopBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border: none;
        border-radius: 50%;
        color: var(--primary-bg);
        cursor: pointer;
        box-shadow: var(--shadow-lg);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    `;
    
    document.body.appendChild(scrollToTopBtn);
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.opacity = '1';
            scrollToTopBtn.style.visibility = 'visible';
        } else {
            scrollToTopBtn.style.opacity = '0';
            scrollToTopBtn.style.visibility = 'hidden';
        }
    });
    
    scrollToTopBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
    });
    
    scrollToTopBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
}

// Initialize scroll to top button
addScrollToTopButton();

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // ESC key to close modals/menus
    if (e.key === 'Escape') {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (navToggle && navMenu && navMenu.classList.contains('active')) {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
        }
        
        hideSuggestions();
    }
    
    // Enter key for search
    if (e.key === 'Enter' && e.target.matches('#productSearch')) {
        e.preventDefault();
        hideSuggestions();
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

// Optimized scroll handler
const handleScroll = debounce(() => {
    // Add scroll-based functionality here if needed
}, 100);

window.addEventListener('scroll', handleScroll);

// Error handling
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
});

// Unhandled promise rejection handling
window.addEventListener('unhandledrejection', function(e) {
    console.error('Unhandled promise rejection:', e.reason);
});

console.log('Truvio website scripts loaded successfully!');
