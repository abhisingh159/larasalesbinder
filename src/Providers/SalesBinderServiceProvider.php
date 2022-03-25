<?php

namespace Achieversaim\Larasalesbinder\Providers;

use Achieversaim\Larasalesbinder\SalesBinder;
use Illuminate\Support\ServiceProvider;

class SalesBinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $config_path = function_exists('config_path') ? config_path('salesbinder.php') : 'salesbinder.php';

        $this->publishes([
            __DIR__.'/../Config/salesbinder.php' => $config_path,
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SalesBinder::class, function ($app) {
            return new SalesBinder();
        });
    }
}
