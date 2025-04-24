@php
    $menuItems = [
        ['route' => 'dashboard', 'label' => 'Trang chủ'],
        ['route' => 'club.index', 'label' => 'Câu lạc bộ'],
        ['route' => 'board_customer.index', 'label' => 'Khách hàng & Đối tác', 'id' => 'customerText'],
        ['route' => 'activity.index', 'label' => 'Hoạt động'],
        ['route' => 'membership_fee.index', 'label' => 'Hội phí'],
        ['route' => 'sponsorship.index', 'label' => 'Tài trợ'],
        ['route' => 'notification.index', 'label' => 'Thông báo'],
        ['route' => 'meeting.index', 'label' => 'Lịch'],
    ];

    $settingsItems = [
        [
            'route' => 'membership_tier.index',
            'label' => 'Hạng thành viên',
            'id' => 'membershipTierText',
        ],
        ['route' => 'role.index', 'label' => 'Quản lý người dùng', 'id' => 'userText'],
        ['route' => 'category.index', 'label' => 'Danh mục', 'id' => 'categoryText'],
        ['route' => 'contact.index', 'label' => 'Liên hệ', 'id' => 'contactText'],
    ];
@endphp
<div class="bg-white text-gray-500" id="sidebar" style="width: 240px; height: 100vh;">
    <!-- Logo -->
    <div class="d-flex justify-content-center align-items-center py-3">
        <a href="{{ route('dashboard') }}">
            <x-application-logo :width="80" :height="97" />
        </a>
    </div>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto m-3">

        @foreach ($menuItems as $item)
            <li class="mb-2">
                <a href="{{ route($item['route']) }}" class="nav-link text-gray-500"
                    @isset($item['id']) id="{{ $item['id'] }}" @endisset>
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach

        <!-- Settings Menu -->
        <li class="mb-2">
            <a class="nav-link text-gray-500 d-flex justify-content-between" href="#" id="settingsToggle"
                role="button">
                Cài đặt
                <i id="arrow" class="fas fa-chevron-down ms-auto mt-1"></i>
            </a>
            <div class="collapse {{ session('settingsSubmenuOpen') == 'true' ? 'show' : '' }}" id="settingsSubmenu">
                <ul class="list-unstyled ps-3">
                    @foreach ($settingsItems as $setting)
                        <li class="mt-2">
                            <a href="{{ route($setting['route']) }}"
                                class="text-gray-500 nav-link text-decoration-none">
                                <span class="setting-text" id="{{ $setting['id'] }}">{{ $setting['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>
</div>
