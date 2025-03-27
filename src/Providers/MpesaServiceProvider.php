<?php

namespace Bruno\Mpesa\Providers;

use Illuminate\Support\ServiceProvider;
use Bruno\Mpesa\Lib\MpesaHelper;
use Illuminate\Support\Facades\Event;
use Webkul\Theme\ViewRenderEventManager;
use Webkul\Checkout\Facades\Cart;

class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'mpesa');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'mpesa');

        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('views/vendor/mpesa'),
        ], 'mpesa-views');

        $this->publishes([
            __DIR__ . '/../Config/system.php' => config_path('mpesa-system.php'),
            __DIR__ . '/../Config/paymentmethods.php' => config_path('mpesa-payment.php'),
            __DIR__ . '/../Config/mpesa.php' => config_path('mpesa.php'),
        ], 'mpesa-config');

        $this->publishes([
            __DIR__ . '/../Resources/lang' => resource_path('lang/vendor/mpesa'),
        ], 'mpesa-lang');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/mpesa'),
        ], 'mpesa-assets');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Include the M-Pesa modal and checkout override on the checkout page
        Event::listen('bagisto.shop.layout.body.after', function($viewRenderEventManager) {
            if (request()->is('checkout/onepage') || request()->is('checkout/onepage/*')) {
                $cart = Cart::getCart();
                if ($cart) {
                    return view('mpesa::mpesa-modal', ['cart' => $cart]) . view('mpesa::checkout-override');
                }
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();

        $this->app->singleton(MpesaHelper::class, function ($app) {
            return new MpesaHelper();
        });
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/paymentmethods.php', 'payment_methods'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/mpesa.php', 'mpesa'
        );
    }
}