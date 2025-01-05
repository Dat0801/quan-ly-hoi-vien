<?php
namespace App\Services;

use Illuminate\Support\Facades\Route;

class BreadcrumbService
{
    private $breadcrumbConfigs = [
        'industry' => ['name' => 'Ngành', 'routes' => ['index', 'create', 'edit', 'show']],
        'field' => ['name' => 'Lĩnh vực', 'routes' => ['index', 'create', 'edit', 'show']],
        'market' => ['name' => 'Thị trường', 'routes' => ['index', 'create', 'edit', 'show']],
        'target_customer_group' => ['name' => 'Khách hàng mục tiêu', 'routes' => ['index', 'create', 'edit', 'show']],
        'certificate' => ['name' => 'Chứng chỉ', 'routes' => ['index', 'create', 'edit', 'show']],
        'organization' => ['name' => 'Tổ chức', 'routes' => ['index', 'create', 'edit', 'show']],
        'business' => ['name' => 'Doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'club' => ['name' => 'Câu lạc bộ', 'routes' => ['index', 'create', 'edit', 'show']],
        'board_customer' => ['name' => 'Ban chấp hành', 'routes' => ['index', 'create', 'edit', 'show']],
        'business_customer' => ['name' => 'Khách hàng doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'individual_customer' => ['name' => 'Khách hàng cá nhân', 'routes' => ['index', 'create', 'edit', 'show']],
        'business_partner' => ['name' => 'Đối tác doanh nghiệp', 'routes' => ['index', 'create', 'edit', 'show']],
        'individual_partner' => ['name' => 'Đối tác cá nhân', 'routes' => ['index', 'create', 'edit', 'show']],
        'club.board_customer' => ['name' => 'Ban điều hành', 'routes' => ['index', 'create', 'edit', 'show']],

    ];

    public function getBreadcrumbs()
    {
        $route = Route::currentRouteName();
        $url = '/'.request()->path();
        $breadcrumbs = [];
        if (strpos($url, 'profile') !== false) {
            $breadcrumbs = [['name' => 'Trang chủ', 'url' => route('dashboard'), 'active' => false]];
            $breadcrumbs[] = ['name' => 'Thông tin cơ bản', 'url' => route('profile.show'), 'active' => true];
        } else if (strpos($url, 'category') !== false) {
            $breadcrumbs[] = ['name' => 'Cài đặt', 'url' => route('category.index'), 'active' => false];
            $breadcrumbs[] = ['name' => 'Danh mục', 'url' => route('category.index'), 'active' => false];

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
        } else if (strpos($url, 'club.') !== false) {
            $newUrl = explode('/', $url)[3];
            $club = request()->route('club');
            $breadcrumbs[] = ['name' => 'Câu lạc bộ', 'url' => route('club.board_customer.index', ['club' => $club]), 'active' => false];
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

        return $breadcrumbs;
    }

    private function generateClubBreadcrumbs($key, $route, $config, $club)
    {
        $breadcrumbs = [];
        $baseRoute = "{$key}.index";
        if ($route === "{$key}.index") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => true];
        } else if ($route === "{$key}.create") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = ['name' => 'Thêm mới', 'url' => route("{$key}.create", ['club' => $club]), 'active' => true];
        } else if ($route === "{$key}.edit") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chỉnh sửa',
                'url' => route("{$key}.edit", [$key => request()->route($key)]),
                'active' => true,
            ];
        } else if ($route === "{$key}.show") {
            $breadcrumbs[] = ['name' => $config['name'], 'url' => route($baseRoute, ['club' => $club]), 'active' => false];
            $breadcrumbs[] = [
                'name' => 'Chi tiết',
                'url' => route("{$key}.show", [$key => request()->route($key), 'club' => $club]),
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
        }

        return $breadcrumbs;
    }
}
