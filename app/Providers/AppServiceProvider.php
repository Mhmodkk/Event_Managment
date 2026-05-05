<?php

namespace App\Providers;

use App\Models\Faculty;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
            try {
                if (Schema::hasTable('faculties')) {
                    $view->with('faculties', Faculty::all());
                } else {
                    $view->with('faculties', collect());
                }
            } catch (\Exception $e) {
                $view->with('faculties', collect());
            }
        });
    }
}
