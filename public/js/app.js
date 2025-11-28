/**
 * SMM AUTO GALLERY - Main JavaScript
 * Pure Vanilla JS - No Framework Dependencies
 */

// ============================================
// 1. UTILITY FUNCTIONS
// ============================================

/**
 * DOM Ready Handler
 */
function ready(fn) {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

/**
 * Toggle Element Display
 */
function toggle(element) {
    if (!element) return;

    if (element.style.display === 'none' || !element.style.display) {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
    }
}

/**
 * Show Element
 */
function show(element) {
    if (!element) return;
    element.style.display = 'block';
}

/**
 * Hide Element
 */
function hide(element) {
    if (!element) return;
    element.style.display = 'none';
}

/**
 * Add Class
 */
function addClass(element, className) {
    if (!element) return;
    element.classList.add(className);
}

/**
 * Remove Class
 */
function removeClass(element, className) {
    if (!element) return;
    element.classList.remove(className);
}

/**
 * Toggle Class
 */
function toggleClass(element, className) {
    if (!element) return;
    element.classList.toggle(className);
}

/**
 * Has Class
 */
function hasClass(element, className) {
    if (!element) return false;
    return element.classList.contains(className);
}

// ============================================
// 2. NAVBAR FUNCTIONALITY
// ============================================

/**
 * Initialize Navbar
 */
function initNavbar() {
    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleClass(mobileMenu, 'active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (e) {
            if (mobileMenu && hasClass(mobileMenu, 'active')) {
                if (!mobileMenu.contains(e.target) && e.target !== mobileMenuToggle) {
                    removeClass(mobileMenu, 'active');
                }
            }
        });
    }

    // Dropdown Menus
    const dropdowns = document.querySelectorAll('[data-dropdown]');

    dropdowns.forEach(function (dropdown) {
        const toggle = dropdown.querySelector('[data-dropdown-toggle]');
        const menu = dropdown.querySelector('[data-dropdown-menu]');

        if (toggle && menu) {
            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                toggleClass(menu, 'active');

                // Add animation
                if (hasClass(menu, 'active')) {
                    addClass(menu, 'animate-fade-in');
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (menu && hasClass(menu, 'active')) {
                    if (!dropdown.contains(e.target)) {
                        removeClass(menu, 'active');
                    }
                }
            });
        }
    });
}

// ============================================
// 3. ADMIN SIDEBAR
// ============================================

/**
 * Initialize Admin Sidebar
 */
function initAdminSidebar() {
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');

    if (sidebar && sidebarToggle) {
        // Remove init class and apply proper collapsed class
        const sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
        if (sidebarCollapsed === 'true') {
            addClass(sidebar, 'collapsed');
        }
        // Remove init class from html element
        document.documentElement.classList.remove('sidebar-collapsed-init');

        sidebarToggle.addEventListener('click', function () {
            toggleClass(sidebar, 'collapsed');

            // Save state to localStorage
            if (hasClass(sidebar, 'collapsed')) {
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        });
    }
}

// ============================================
// 4. FORM UTILITIES
// ============================================

/**
 * Format Rupiah Input
 */
function formatRupiah(input) {
    if (!input) return;

    // Get the input value and remove all non-digit characters
    let value = input.value.replace(/[^\d]/g, '');

    // Find the corresponding hidden input
    let hiddenInputId = input.id.replace('_display', '_value')
        .replace('max_price_home', 'max_price_value_home')
        .replace('max_price_catalog', 'max_price_value_catalog');

    let hiddenInput = document.getElementById(hiddenInputId);

    // Store the raw numeric value in the hidden field
    if (hiddenInput) {
        hiddenInput.value = value;
    }

    // Format with thousand separators
    if (value) {
        // Add thousand separators (comma)
        let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        input.value = formatted;
    } else {
        input.value = '';
    }
}

/**
 * Initialize Rupiah Inputs
 */
function initRupiahInputs() {
    const rupiahInputs = document.querySelectorAll('[data-rupiah-input]');

    rupiahInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            formatRupiah(this);
        });
    });
}

/**
 * Auto-submit form on select change
 */
function initAutoSubmitForms() {
    const autoSubmitSelects = document.querySelectorAll('[data-auto-submit]');

    autoSubmitSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            this.form.submit();
        });
    });
}

// ============================================
// 5. ALERTS & NOTIFICATIONS
// ============================================

/**
 * Auto-dismiss alerts
 */
function initAlerts() {
    const alerts = document.querySelectorAll('[data-alert]');

    alerts.forEach(function (alert) {
        const dismissButton = alert.querySelector('[data-alert-dismiss]');

        if (dismissButton) {
            dismissButton.addEventListener('click', function () {
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.remove();
                }, 300);
            });
        }

        // Auto-dismiss after 5 seconds
        const autoDismiss = alert.getAttribute('data-auto-dismiss');
        if (autoDismiss !== 'false') {
            setTimeout(function () {
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.remove();
                }, 300);
            }, 5000);
        }
    });
}

// ============================================
// 6. IMAGE PREVIEW
// ============================================

/**
 * Preview image before upload
 */
function initImagePreview() {
    const imageInputs = document.querySelectorAll('[data-image-preview]');

    imageInputs.forEach(function (input) {
        const previewId = input.getAttribute('data-image-preview');
        const preview = document.getElementById(previewId);

        if (preview) {
            input.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        show(preview);
                    };

                    reader.readAsDataURL(file);
                }
            });
        }
    });
}

// ============================================
// 7. CONFIRMATION DIALOGS
// ============================================

/**
 * Confirm before form submission
 */
function initConfirmForms() {
    const confirmForms = document.querySelectorAll('[data-confirm]');

    confirmForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const message = form.getAttribute('data-confirm');

            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }
        });
    });
}

/**
 * Confirm before link click
 */
function initConfirmLinks() {
    const confirmLinks = document.querySelectorAll('[data-confirm-link]');

    confirmLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            const message = link.getAttribute('data-confirm-link');

            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }
        });
    });
}

// ============================================
// 8. SMOOTH SCROLL
// ============================================

/**
 * Smooth scroll to anchor links
 */
function initSmoothScroll() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            const href = link.getAttribute('href');

            if (href === '#') return;

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// ============================================
// 9. TABS
// ============================================

/**
 * Initialize tabs
 */
function initTabs() {
    const tabContainers = document.querySelectorAll('[data-tabs]');

    tabContainers.forEach(function (container) {
        const tabs = container.querySelectorAll('[data-tab]');
        const panels = container.querySelectorAll('[data-tab-panel]');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = tab.getAttribute('data-tab');

                // Remove active class from all tabs
                tabs.forEach(function (t) {
                    removeClass(t, 'active');
                });

                // Add active class to clicked tab
                addClass(tab, 'active');

                // Hide all panels
                panels.forEach(function (panel) {
                    hide(panel);
                });

                // Show target panel
                const targetPanel = document.getElementById(targetId);
                if (targetPanel) {
                    show(targetPanel);
                }
            });
        });
    });
}

// ============================================
// 10. MODAL
// ============================================

/**
 * Initialize modals
 */
function initModals() {
    const modalTriggers = document.querySelectorAll('[data-modal-trigger]');

    modalTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();

            const modalId = trigger.getAttribute('data-modal-trigger');
            const modal = document.getElementById(modalId);

            if (modal) {
                show(modal);
                addClass(modal, 'active');
            }
        });
    });

    const modalCloses = document.querySelectorAll('[data-modal-close]');

    modalCloses.forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            const modal = closeBtn.closest('[data-modal]');

            if (modal) {
                removeClass(modal, 'active');
                setTimeout(function () {
                    hide(modal);
                }, 300);
            }
        });
    });

    // Close modal when clicking outside
    const modals = document.querySelectorAll('[data-modal]');

    modals.forEach(function (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                removeClass(modal, 'active');
                setTimeout(function () {
                    hide(modal);
                }, 300);
            }
        });
    });
}

// ============================================
// 11. INITIALIZE ALL
// ============================================

/**
 * Initialize all components
 */
ready(function () {
    console.log('SMM AUTO GALLERY - Initialized');

    // Initialize components
    initNavbar();
    initAdminSidebar();
    initRupiahInputs();
    initAutoSubmitForms();
    initAlerts();
    initImagePreview();
    initConfirmForms();
    initConfirmLinks();
    initSmoothScroll();
    initTabs();
    initModals();
});

// ============================================
// 12. EXPOSE GLOBAL FUNCTIONS
// ============================================

// Make formatRupiah available globally for inline handlers
window.formatRupiah = formatRupiah;
window.toggle = toggle;
window.show = show;
window.hide = hide;
