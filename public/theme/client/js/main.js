// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Book search functionality
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = document.querySelector('#search-input').value;
            // Implement search functionality here
            console.log('Searching for:', searchTerm);
        });
    }

    // Book borrowing functionality
    const borrowButtons = document.querySelectorAll('.borrow-btn');
    borrowButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookId = this.dataset.bookId;
            // Implement borrowing functionality here
            console.log('Borrowing book:', bookId);
        });
    });

    // User profile update
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Implement profile update functionality here
            console.log('Updating profile');
        });
    }

    // Contact form submission
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Implement contact form submission here
            console.log('Submitting contact form');
        });
    }

    // Book rating functionality
    const ratingStars = document.querySelectorAll('.rating-star');
    ratingStars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            // Implement rating functionality here
            console.log('Rating:', rating);
        });
    });

    // Category filter
    const categoryFilters = document.querySelectorAll('.category-filter');
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const category = this.dataset.category;
            // Implement category filtering here
            console.log('Filtering by category:', category);
        });
    });

    // Advanced search toggle
    const advancedSearchToggle = document.querySelector('.advanced-search-toggle');
    if (advancedSearchToggle) {
        advancedSearchToggle.addEventListener('click', function() {
            const advancedSearch = document.querySelector('.advanced-search');
            advancedSearch.classList.toggle('d-none');
        });
    }

    // Book availability check
    const checkAvailability = function(bookId) {
        // Implement availability check here
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve(true); // Mock response
            }, 500);
        });
    };

    // Loading spinner
    const showSpinner = function() {
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        document.body.appendChild(spinner);
    };

    const hideSpinner = function() {
        const spinner = document.querySelector('.spinner');
        if (spinner) {
            spinner.remove();
        }
    };

    // Responsive navigation
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            navbarCollapse.classList.toggle('show');
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form validation
    const validateForm = function(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        return isValid;
    };

    // Initialize all forms with validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}); 