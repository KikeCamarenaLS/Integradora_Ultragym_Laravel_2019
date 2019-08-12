<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'producto';
    protected $fillable=['Nombre_Producto','Descripcion','Precio','Existencia','image_url'];
}
