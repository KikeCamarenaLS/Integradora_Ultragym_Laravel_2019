<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductosCollection;

class TiendaController extends Controller
{
    public function principal(){
    	return view('Productos.tienda');
    }

    public function productos(){

    	$producto = DB::table('producto')
    	->join('categoria_producto', 'producto.id_categoria', '=' , 'categoria_producto.id_categoria')
    	->paginate(12);

    	return new ProductosCollection($producto);
    }
}
