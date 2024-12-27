document.addEventListener('DOMContentLoaded', function() {
    const settingsLink = document.getElementById('settingsToggle');
    const settingsSubmenu = document.getElementById('settingsSubmenu');
    const arrow = document.getElementById('arrow');

    function isInSettingsPage() {
        return window.location.pathname.includes('/category/')
    }

    const categoryText = document.getElementById('categoryText');
    if (isInSettingsPage()) {
        categoryText.classList.add('active');
        settingsSubmenu.classList.add('show'); 
        settingsLink.classList.add('active'); 
    } else {
        categoryText.classList.remove('active');
    }

    if (sessionStorage.getItem('settingsSubmenuOpen') === 'true' && isInSettingsPage()) {
        settingsSubmenu.classList.add('show');
        settingsLink.classList.add('active');
        arrow.classList.remove('fa-chevron-down');
        arrow.classList.add('fa-chevron-up');
    } else {
        settingsSubmenu.classList.remove('show');
        settingsLink.classList.remove('active');
        arrow.classList.remove('fa-chevron-up');
        arrow.classList.add('fa-chevron-down');
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

    const sidebarLinks = document.querySelectorAll('.nav-link');
    sidebarLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (link.getAttribute('href') === '#') {
                event.preventDefault();
            }
        });
    });
});