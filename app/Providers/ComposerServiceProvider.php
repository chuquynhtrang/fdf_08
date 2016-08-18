<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('home', 'App\Http\ViewComposers\HomeComposer');
        view()->composer([
            'product.show', 
            'product.get-cart',
            'product.suggest',
            'user.profile',
            'user.order_information',
            'user.show_order',
            'product.checkout',
        ], 'App\Http\ViewComposers\ProductComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
