<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\BreadcrumbService;
use Illuminate\Support\Facades\URL;

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

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
