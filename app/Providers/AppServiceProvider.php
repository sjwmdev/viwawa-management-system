<?php

namespace App\Providers;

use App\Observers\GlobalObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        // Observe all models
        $models = config('global-observer.models'); // Define models in the config
        foreach ($models as $model) {
            $model::observe(GlobalObserver::class);
        }
    }
}
