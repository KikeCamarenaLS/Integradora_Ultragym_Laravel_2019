<?php

namespace App\Http\Middleware;

use Closure;
use App\CarritoCompras;

class SetShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Nombre para la sesion del carrito
        $sessionName = '$shopping_cart_id';
        $shopping_cart_id = \Session::get($sessionName);

        $shopping_cart = CarritoCompras::findOrCreateById($shopping_cart_id);

        \Session::put($sessionName, $shopping_cart->id);

        $request->shopping_cart = $shopping_cart; //respuesta a controlador
        return $next($request);
    }
}
