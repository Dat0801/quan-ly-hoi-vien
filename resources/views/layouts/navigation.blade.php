<nav x-data="{ open: false }">
    <div class="d-flex justify-content-between align-items-center h-16 w-full" style="margin-left: 1%">
        <!-- Logo và Breadcrumb nằm cùng một hàng -->
        <div class="d-flex align-items-center">
            <!-- Breadcrumb chỉ hiển thị nếu không phải trang chủ -->
            @if (!request()->is('dashboard'))
            <div class="ms-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #FF7506; font-weight: bold;">Thông tin cơ bản</li>
                    </ol>
                </nav>
            </div>
            @endif
        </div>

        <!-- User Settings (phần tử bên phải) -->
        <div class="hidden sm:flex sm:items-center sm:ml-6" style="margin: 6%">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <!-- Avatar -->
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->avatar ?? '/images/avt.png' }}" alt="User Avatar" class="w-8 h-8 mr-2" style="border-radius: 50%; object-fit: cover;">
                    <div class="text-left">
                        <div style="color: #803B03;">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->role->role_name }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>
