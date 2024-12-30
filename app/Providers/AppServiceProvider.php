<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\BreadcrumbService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(BreadcrumbService $breadcrumbService) // Inject service vào
    {
        View::composer('*', function ($view) use ($breadcrumbService) {
            $breadcrumbs = $breadcrumbService->getBreadcrumbs();
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }
}
