<!-- Sidebar -->
<div class="bg-white text-gray-500" id="sidebar" style="width: 240px; height: 100vh;">
    <!-- Logo -->
    <div class="d-flex justify-content-center align-items-center py-3">
        <a href="{{ route('dashboard') }}"><img src="/images/Logo.png" alt="Logo" class="img-fluid logo-img" style="width: 80px; height: auto;"/></a>
    </div>
    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto ml-4">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-gray-500" aria-current="page">Trang chủ</a>
        </li>
        <li><a href="#" class="nav-link text-gray-500">Câu lạc bộ</a></li>
        <li><a href="#" class="nav-link text-gray-500">Khách hàng & Đối tác</a></li>
        <li><a href="#" class="nav-link text-gray-500">Hoạt động</a></li>
        <li><a href="#" class="nav-link text-gray-500">Hội phí</a></li>
        <li><a href="#" class="nav-link text-gray-500">Tài trợ</a></li>
        <li><a href="#" class="nav-link text-gray-500">Thông báo</a></li>
        <li><a href="#" class="nav-link text-gray-500">Lịch</a></li>
        <li>
            <a class="nav-link text-gray-500 d-flex justify-content-between" href="#" id="settingsToggle" role="button">
                Cài đặt 
                <i id="arrow" class="fas fa-chevron-down ms-auto mt-1"></i>
            </a>
            <div class="collapse" id="settingsSubmenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="text-gray-500 nav-link text-decoration-none">Hạng thành viên</a></li>
                    <li><a href="#" class="text-gray-500 nav-link text-decoration-none">Quản lý người dùng</a></li>
                    <li><a href="#" class="text-gray-500 nav-link text-decoration-none">Danh mục</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<script>
// Lấy các phần tử cần thiết
const settingsLink = document.getElementById('settingsToggle');
const settingsSubmenu = document.getElementById('settingsSubmenu');
const arrow = document.getElementById('arrow');

// Thêm sự kiện click vào nút "Cài đặt"
settingsLink.addEventListener('click', function(event) {
    // Ngừng sự kiện mặc định của thẻ <a>
    event.preventDefault();

    // Toggle 'active' class để thay đổi màu
    settingsLink.classList.toggle('active');
    settingsSubmenu.classList.toggle('show');

    // Thay đổi mũi tên khi mở và đóng menu
    if (settingsSubmenu.classList.contains('show')) {
        arrow.classList.remove('fa-chevron-down');
        arrow.classList.add('fa-chevron-up');
    } else {
        arrow.classList.remove('fa-chevron-up');
        arrow.classList.add('fa-chevron-down');
    }
});
</script>
