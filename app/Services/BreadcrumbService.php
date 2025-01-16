<?php
namespace App\Services;

use Illuminate\Support\Facades\Route;

class BreadcrumbService
{
    private $breadcrumbConfigs = [
        //settings 
        'industry' => ['name' => 'Ngành', 'routes' => ['index', 'create', 'edit', 'show']],
        'field' => ['name' => 'Lĩnh vực', 'routes' => ['index', 'create', 'edit', 'show']],
        'market' => ['name' => 'Thị trường', 'routes' => ['index', 'create', 'edit', 'show']],
        'target_customer_group' => ['name' => 'Khách hàng mục tiêu', 'routes' => ['index', 'create', 'edit', 'show']],
        'certificate' => ['name' => 'Chứng chỉ', 'routes' => ['index', 'create', 'edit', 'show']],
        'organization' => ['name' => 'Tổ chức', 'routes' => ['index', 'create', 'edit', 'show']],
        'business' => ['name' => 'Doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'contact' => ['name' => 'Liên hệ', 'routes' => ['edit', 'index']],
        'membership_tier' => ['name' => 'Hạng thành viên', 'routes' => ['index', 'create', 'edit', 'show']],
        
        //club
        'club' => ['name' => 'Câu lạc bộ', 'routes' => ['index', 'create', 'edit', 'show']],

        //customer
        'board_customer' => ['name' => 'Ban chấp hành', 'routes' => ['index', 'create', 'edit', 'show']],
        'business_customer' => ['name' => 'Khách hàng doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'individual_customer' => ['name' => 'Khách hàng cá nhân', 'routes' => ['index', 'create', 'edit', 'show']],
        'business_partner' => ['name' => 'Đối tác doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'individual_partner' => ['name' => 'Đối tác cá nhân', 'routes' => ['index', 'create', 'edit', 'show']],
        
        'activity' => ['name' => 'Hoạt động', 'routes' => ['index', 'create', 'edit', 'show']],
        'membership_fee' => ['name' => 'Hội phí', 'routes' => ['index', 'create']],
        'sponsorship' => ['name' => 'Tài trợ', 'routes' => ['index', 'create', 'show']],
        'notification' => ['name' => 'Thông báo', 'routes' => ['index', 'create', 'edit', 'show']],
        'meeting' => ['name' => 'Lịch', 'routes' => ['index', 'create', 'edit', 'show']],

        //user 
        'role' => ['name' => 'Vai trò', 'routes' => ['index', 'create', 'edit', 'show']],
        'account' => ['name' => 'Tài khoản', 'routes' => ['index', 'create', 'edit', 'show']],

    ];

    public function getBreadcrumbs()
    {
        $route = Route::currentRouteName();
        $url = '/' . request()->path();
        $breadcrumbs = [];
        if (strpos($url, 'profile') !== false) {
            $breadcrumbs = [['name' => 'Trang chủ', 'url' => route('dashboard'), 'active' => false]];
            $breadcrumbs[] = ['name' => 'Thông tin cơ bản', 'url' => route('profile.show'), 'active' => true];
        } else if (strpos($url, '/settings/') !== false) {
            if (strpos($url, '/category/') !== false) {
                $breadcrumbs[] = ['name' => 'Cài đặt', 'url' => route('category.index'), 'active' => false];
                $breadcrumbs[] = ['name' => 'Danh mục', 'url' => route('category.index'), 'active' => false];
            } else {
                $breadcrumbs[] = ['name' => 'Cài đặt', 'url' => route('category.index'), 'active' => false];
            }
            foreach ($this->breadcrumbConfigs as $key => $config) {
                if (strpos($url, $key) !== false) {
                    $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
                    break;
                }
            }
        } else if (strpos($url, '/customer/') !== false) {
            $newUrl = explode('/', $url)[2];
            $breadcrumbs[] = ['name' => 'Khách hàng và đối tác', 'url' => route('board_customer.index'), 'active' => false];
            foreach ($this->breadcrumbConfigs as $key => $config) {
                if ($newUrl == $key) {
                    $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
                    break;
                }
            }
        } else if (strpos($url, '/club/') !== false) {
            $club = request()->route('club');
            if ($club != null) {
                if (
                    strpos($url, '/club/' . $club->id . '/') !== false
                    && strpos($url, '/club/' . $club->id . '/edit') === false
                ) {
                    $newUrl = explode('/', $url)[3];
                    $breadcrumbs[] = ['name' => 'Câu lạc bộ', 'url' => route('club.index', ['club' => $club]), 'active' => false];
                    foreach ($this->breadcrumbConfigs as $key => $config) {
                        if ($newUrl == $key) {
                            $breadcrumbs = array_merge($breadcrumbs, $this->generateClubBreadcrumbs($key, $route, $config, $club));
                            break;
                        }
                    }
                } else {
                    foreach ($this->breadcrumbConfigs as $key => $config) {
                        if (strpos($url, $key) !== false) {
                            $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
                            break;
                        }
                    }
                }
            } else {
                foreach ($this->breadcrumbConfigs as $key => $config) {
                    if (strpos($url, $key) !== false) {
                        $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
                        break;
                    }
                }
            }
        } else {
            foreach ($this->breadcrumbConfigs as $key => $config) {
                if (strpos($url, $key) !== false) {
                    $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
                    break;
                }
            }
        }

        return $breadcrumbs;
    }

    private function generateClubBreadcrumbs($key, $route, $config, $club)
    {
        $breadcrumbs = [];
        $baseRoute = "club.{$key}.index";
        if ($route === "club.{$key}.index") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => true];
        } else if ($route === "club.{$key}.create") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = ['name' => 'Thêm mới', 'url' => route("club.{$key}.create", ['club' => $club]), 'active' => true];
        } else if ($route === "club.{$key}.edit") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chỉnh sửa',
                'url' => route("club.{$key}.edit", [$key => request()->route($key), 'club' => $club]),
                'active' => true,
            ];
        } else if ($route === "club.{$key}.show") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chi tiết',
                'url' => route("club.{$key}.show", [$key => request()->route($key), 'club' => $club]),
                'active' => true,
            ];
        }
        return $breadcrumbs;
    }


    private function generateBreadcrumbs($key, $route, $config)
    {
        $breadcrumbs = [];
        $baseRoute = "{$key}.index";
        if ($route === "{$key}.index") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => true];
        } else if ($route === "{$key}.create") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
            $breadcrumbs[] = ['name' => 'Thêm mới', 'url' => route("{$key}.create"), 'active' => true];
        } else if ($route === "{$key}.edit") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chỉnh sửa',
                'url' => route("{$key}.edit", [$key => request()->route($key)]),
                'active' => true,
            ];
        } else if ($route === "{$key}.show") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chi tiết',
                'url' => route("{$key}.show", [$key => request()->route($key)]),
                'active' => true,
            ];
        } else if ($route === "{$key}.sponsorship_history") {
            $customerId = request()->route('customerId');

            if ($customerId) {
                $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
                $breadcrumbs[] = [
                    'name' => 'Lịch sử tài trợ',
                    'url' => route("{$key}.sponsorship_history", ['customerId' => $customerId]),
                    'active' => true,
                ];
            }
        } else if ($route === "{$key}.membership-fee-history") {
            $customerId = request()->route('customerId');

            if ($customerId) {
                $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
                $breadcrumbs[] = [
                    'name' => 'Lịch sử đóng hội phí',
                    'url' => route("{$key}.membership-fee-history", ['customerId' => $customerId]),
                    'active' => true,
                ];
            }
        } else if ($route === "{$key}.participants") {
            $id = request()->route('id');

            if ($id) {
                $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute), 'active' => false];
                $breadcrumbs[] = ['name' => "Chi tiết hoạt động", 'url' => route("{$key}.show", ['activity' => $id]), 'active' => false];
                $breadcrumbs[] = [
                    'name' => 'Danh sách người tham gia',
                    'url' => route("{$key}.participants", ['id' => $id]),
                    'active' => true,
                ];
            }
        }

        return $breadcrumbs;
    }
}
