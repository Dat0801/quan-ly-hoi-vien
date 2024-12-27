document.addEventListener('DOMContentLoaded', function() {
    const settingsLink = document.getElementById('settingsToggle');
    const settingsSubmenu = document.getElementById('settingsSubmenu');
    const arrow = document.getElementById('arrow');

    function isInSettingsPage() {
        return window.location.pathname.includes('category'); 
    }

    const categoryText = document.getElementById('categoryText');
    if (isInSettingsPage()) {
        categoryText.classList.add('active');
        settingsSubmenu.classList.add('show'); // Mở menu cài đặt
        settingsLink.classList.add('active'); // Đánh dấu "Cài đặt"
    } else {
        categoryText.classList.remove('active');
    }

    // Kiểm tra trạng thái submenu từ sessionStorage (giữ trạng thái sau khi reload trang)
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

    // Xử lý sự kiện click vào "Cài đặt"
    settingsLink.addEventListener('click', function(event) {
        event.preventDefault(); // Ngừng hành động mặc định của link, tránh reload trang

        settingsSubmenu.classList.toggle('show');

        if (settingsSubmenu.classList.contains('show')) {
            arrow.classList.remove('fa-chevron-down');
            arrow.classList.add('fa-chevron-up');
            sessionStorage.setItem('settingsSubmenuOpen', 'true'); // Lưu trạng thái submenu mở
            settingsLink.classList.add('active');
        } else {
            arrow.classList.remove('fa-chevron-up');
            arrow.classList.add('fa-chevron-down');
            sessionStorage.setItem('settingsSubmenuOpen', 'false'); // Lưu trạng thái submenu đóng
            settingsLink.classList.remove('active');
        }
    });

    // Ngừng reload trang khi click vào các link trong sidebar (trừ "Cài đặt")
    const sidebarLinks = document.querySelectorAll('.nav-link');
    sidebarLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (link.getAttribute('href') === '#') {
                event.preventDefault(); // Ngừng reload trang khi click vào các link không có URL thực tế
            }
        });
    });
});