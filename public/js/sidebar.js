document.addEventListener('DOMContentLoaded', function() {
    const settingsLink = document.getElementById('settingsToggle');
    const settingsSubmenu = document.getElementById('settingsSubmenu');
    const arrow = document.getElementById('arrow');

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

    if (sessionStorage.getItem('settingsSubmenuOpen') === 'true') {
        settingsSubmenu.classList.add('show');
        arrow.classList.remove('fa-chevron-down');
        arrow.classList.add('fa-chevron-up');
        settingsLink.classList.add('active');
    } else {
        settingsSubmenu.classList.remove('show');
        arrow.classList.remove('fa-chevron-up');
        arrow.classList.add('fa-chevron-down');
        settingsLink.classList.remove('active');
    }
});