<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        view()->composer('home', function($view) {
            $view->with('nominees', \App\Models\User::latest()->get());
        });

        view()->composer('home', function($view) {
            $view->with('grades', \App\Models\GradeLevel::latest()->get());
        });

        view()->composer('dashboard', function($view) {
            $view->with('nominees', \App\Models\User::orderBy('name')->get());
        });

        view()->composer('dashboard', function($view) {
            $view->with('grades', \App\Models\GradeLevel::latest()->get());
        });

        view()->composer('dashboard', function($view) {
            $view->with('zonals', \App\Models\Zonal::latest()->get());
        });

        view()->composer('dashboard', function($view) {
            $view->with('categories', \App\Models\Category::latest()->get());
        });

        view()->composer('dashboard', function($view) {
            $view->with('criterias', \App\Models\Criteria::latest()->get());
        });
    }
}
