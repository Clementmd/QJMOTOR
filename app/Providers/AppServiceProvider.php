<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Type; 

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
        View::composer(['welcome', 'layouts.*'], function ($view) {
            $menuNavigation = Type::with('categories.produits')->get();
            $view->with('menuNavigation', $menuNavigation);
        });
    }
}
