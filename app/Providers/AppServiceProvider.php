<?php

namespace App\Providers;

use App\Models\Faculty;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        view()->composer('layouts.main-navigation', function ($view) {
            $view->with('faculties', Faculty::all());
        });
    }
}
