@php
    $menuItems = [
        ['base_route' => 'dashboard', 'active_routes' => ['dashboard'], 'label' => 'Trang chủ'],
        ['base_route' => 'club.index', 'active_routes' => ['club.*'], 'label' => 'Câu lạc bộ'],
        [
            'base_route' => 'board_customer.index',
            'active_routes' => [
                'board_customer.*',
                'business_customer.*',
                'individual_customer.*',
                'business_partner.*',
                'individual_partner.*',
            ],
            'label' => 'Khách hàng & Đối tác',
        ],
        ['base_route' => 'activity.index', 'active_routes' => ['activity.*'], 'label' => 'Hoạt động'],
        ['base_route' => 'membership_fee.index', 'active_routes' => ['membership_fee.*'], 'label' => 'Hội phí'],
        ['base_route' => 'sponsorship.index', 'active_routes' => ['sponsorship.*'], 'label' => 'Tài trợ'],
        ['base_route' => 'notification.index', 'active_routes' => ['notification.*'], 'label' => 'Thông báo'],
        ['base_route' => 'meeting.index', 'active_routes' => ['meeting.*'], 'label' => 'Lịch'],
    ];

    $settingsItems = [
        ['base_route' => 'membership_tier.index', 'active_routes' => ['membership_tier.*'], 'label' => 'Hạng thành viên'],
        ['base_route' => 'role.index', 'active_routes' => ['role.*', 'account.*'], 'label' => 'Quản lý người dùng'],
        [
            'base_route' => 'industry.index',
            'active_routes' => [
                'industry.*',
                'field.*',
                'market.*',
                'target_customer_group.*',
                'certificate.*',
                'organization.*',
                'business.*',
            ],
            'label' => 'Danh mục',
        ],
        ['base_route' => 'contact.index', 'active_routes' => ['contact.*'], 'label' => 'Liên hệ'],
    ];
@endphp

<div class="bg-white text-gray-500" id="sidebar" style="width: 240px; height: 100vh; flex-shrink: 0;">
    <!-- Logo -->
    <div class="d-flex justify-content-center align-items-center py-3">
        <a href="{{ route('dashboard') }}">
            <x-application-logo :width="80" :height="97" />
        </a>
    </div>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto m-3">
        @foreach ($menuItems as $item)
            <x-sidebar-item :item="$item" />
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
                        <x-sidebar-item :item="$setting" :in-setting="true"/>
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>
</div>
