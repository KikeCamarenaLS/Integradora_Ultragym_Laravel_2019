<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductoEnCarrito;

class ProductosEnCarritoComprasController extends Controller
{
	public function __construct(){
		$this->middleware("shopping_cart");
	}

    public function store(Request $request)
    {
    	$in_shopping_cart = ProductoEnCarrito::create([
    		'id_producto' => $request->id_producto,
    		'id_carrito_compras' => $request->shopping_cart->id,
    	]);

    	if($in_shopping_cart){
    		return redirect()->back();
    	}

    	return redirect()->back()->withErrors(['producto' => 'No se pudo cargar el producto']);
    }

    public function destroy($id){

    }
}
