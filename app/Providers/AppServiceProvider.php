<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\CarritoCompras;

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
        View::composer('*', function($view){
            //Nombre para la sesion del carrito
            $sessionName = '$shopping_cart_id';
            $shopping_cart_id = \Session::get($sessionName);

            $shopping_cart = CarritoCompras::findOrCreateById($shopping_cart_id);

            \Session::put($sessionName, $shopping_cart->id);

            $view->with('carritoCuenta', $shopping_cart->productsCount());
        });
        
    }
}
