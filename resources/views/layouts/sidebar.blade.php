@php
    $menuItems = [
        ['base_route' => 'dashboard', 'active_routes' => ['dashboard'], 'label' => 'Trang chủ'],
        ['base_route' => 'club.index', 'active_routes' => ['club.index'], 'label' => 'Câu lạc bộ'],
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
        ['base_route' => 'activity.index', 'active_routes' => ['activity.index'], 'label' => 'Hoạt động'],
        ['base_route' => 'membership_fee.index', 'active_routes' => ['membership_fee.index'], 'label' => 'Hội phí'],
        ['base_route' => 'sponsorship.index', 'active_routes' => ['sponsorship.index'], 'label' => 'Tài trợ'],
        ['base_route' => 'notification.index', 'active_routes' => ['notification.index'], 'label' => 'Thông báo'],
        ['base_route' => 'meeting.index', 'active_routes' => ['meeting.index'], 'label' => 'Lịch'],
    ];

    $settingsItems = [
        ['base_route' => 'membership_tier.index', 'active_routes' => ['membership_tier.index'], 'label' => 'Hạng thành viên'],
        ['base_route' => 'role.index', 'active_routes' => ['role.index', 'account.index'], 'label' => 'Quản lý người dùng'],
        [
            'base_route' => 'industry.index',
            'active_routes' => [
                'industry.index',
                'field.index',
                'market.index',
                'target_customer_group.index',
                'certificate.index',
                'organization.index',
                'business.index',
            ],
            'label' => 'Danh mục',
        ],
        ['base_route' => 'contact.index', 'active_routes' => ['contact.index'], 'label' => 'Liên hệ'],
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
                <x-nav-link :href="route($item['base_route'])" :active="request()->routeIs(...$item['active_routes'])">
                    {{ $item['label'] }}
                </x-nav-link>
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
                            <x-nav-link :href="route($setting['base_route'])" :active-text="request()->routeIs(...$setting['active_routes'])">
                                {{ $setting['label'] }}
                            </x-nav-link>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>
</div>
