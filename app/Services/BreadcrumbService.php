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
    ];

    public function getBreadcrumbs()
    {
        $route = Route::currentRouteName();
        $url = request()->path();

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
        } else if(strpos($url, 'customer') !== false) {
            $breadcrumbs[] = ['name' => 'Khách hàng', 'url' => route('board_customer.index'), 'active' => false];

            foreach ($this->breadcrumbConfigs as $key => $config) {
                if (strpos($url, $key) !== false) {
                    $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($key, $route, $config));
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
        }

        return $breadcrumbs;
    }
}
