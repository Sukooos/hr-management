<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuTree = Menu::getMenuTree(); // method ini terserah kamu, intinya hasil menu tree dari db
            $view->with('menuTree', $menuTree);
        });
        // Atau jika ingin menggunakan View::share
        // View::share('menuTree', Menu::getMenuTree());
    }
}
