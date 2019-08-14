<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoEnCarrito extends Model
{
    protected $table = 'producto_en_carritos';
    protected $fillable=['id_producto', 'id_carrito_compras'];
}
