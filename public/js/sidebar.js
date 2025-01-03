document.addEventListener('DOMContentLoaded', function() {
    const settingsLink = document.getElementById('settingsToggle');
    const settingsSubmenu = document.getElementById('settingsSubmenu');
    const arrow = document.getElementById('arrow');
    const sidebarLinks = document.querySelectorAll('.nav-link');
    
    function isInSettingsPage() {
        return window.location.pathname.includes('/category/');
    }

    function isInCategoryPage() {
        return window.location.pathname.includes('/category');
    }

    function isInCustomerPage() {
        return window.location.pathname.includes('/customer');
    }

    function setActiveSidebarLink() {
        sidebarLinks.forEach(function(link) {
            if (window.location.href.startsWith(link.href)) {
                if(!window.location.pathname.includes('/category/')) {
                    link.classList.add('active');
                }
            } else {
                link.classList.remove('active');
            }
        });

        if (isInSettingsPage()) {
            settingsLink.classList.add('active');
            settingsSubmenu.classList.add('show'); 
            arrow.classList.remove('fa-chevron-down');
            arrow.classList.add('fa-chevron-up');
        } else {
            settingsLink.classList.remove('active');
            settingsSubmenu.classList.remove('show');
            arrow.classList.remove('fa-chevron-up');
            arrow.classList.add('fa-chevron-down');
        }

        const categoryText = document.getElementById('categoryText');
        if (isInCategoryPage()) {
            categoryText.classList.add('active');
        } else {
            categoryText.classList.remove('active');
        }

        const customerText = document.getElementById('customerText');
        if (isInCustomerPage()) {
            customerText.classList.add('active');
        } else {
            customerText.classList.remove('active');
        }
    }

    settingsLink.addEventListener('click', function(event) {
        event.preventDefault();

        settingsSubmenu.classList.toggle('show');

        if (settingsSubmenu.classList.contains('show')) {
            arrow.classList.remove('fa-chevron-down');
            arrow.classList.add('fa-chevron-up');
            sessionStorage.setItem('settingsSubmenuOpen', 'true');
            settingsLink.classList.add('active');
        } else {
            arrow.classList.remove('fa-chevron-up');
            arrow.classList.add('fa-chevron-down');
            sessionStorage.setItem('settingsSubmenuOpen', 'false');
            settingsLink.classList.remove('active');
        }
    });

    setActiveSidebarLink();

    sidebarLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (link.getAttribute('href') === '#') {
                event.preventDefault();
            }
        });
    });
});
