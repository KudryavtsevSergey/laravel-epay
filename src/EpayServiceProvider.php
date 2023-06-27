<?php

declare(strict_types=1);

namespace Sun\Epay;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class EpayServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerPublishing();
    }

    protected function registerRoutes(): void
    {
        if (Epay::$registersRoutes) {
            Route::group([
                'prefix' => config('epay.path', 'epay'),
            ], function (): void {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
        }
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/epay.php' => config_path('epay.php')
            ], 'epay-config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/epay.php', 'epay');

        $this->app->singleton(Facade::FACADE_ACCESSOR, Epay::class);
    }
}
