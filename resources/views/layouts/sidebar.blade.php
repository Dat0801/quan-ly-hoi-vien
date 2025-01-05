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
        <li><a href="{{ route('club.index') }}" class="nav-link text-gray-500">Câu lạc bộ</a></li>
        <li><a href="{{ route('board_customer.index') }}" class="nav-link text-gray-500" id="customerText">Khách hàng & Đối tác</a></li>
        <li><a href="#" class="nav-link text-gray-500">Hoạt động</a></li>
        <li><a href="#" class="nav-link text-gray-500">Hội phí</a></li>
        <li><a href="{{ route('sponsorships.index') }}" class="nav-link text-gray-500">Tài trợ</a></li>
        <li><a href="#" class="nav-link text-gray-500">Thông báo</a></li>
        <li><a href="#" class="nav-link text-gray-500">Lịch</a></li>
        <li>
            <a class="nav-link text-gray-500 d-flex justify-content-between" href="#" id="settingsToggle" role="button">
                Cài đặt
                <i id="arrow" class="fas fa-chevron-down ms-auto mt-1"></i>
            </a>
            <div class="collapse {{ session('settingsSubmenuOpen') == 'true' ? 'show' : '' }}" id="settingsSubmenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="text-gray-500 nav-link text-decoration-none">Hạng thành viên</a></li>
                    <li><a href="#" class="text-gray-500 nav-link text-decoration-none">Quản lý người dùng</a></li>
                    <li>
                        <a href="{{ route('category.index') }}" class="text-gray-500 nav-link text-decoration-none">
                            <span class="category-text" id="categoryText">Danh mục</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
