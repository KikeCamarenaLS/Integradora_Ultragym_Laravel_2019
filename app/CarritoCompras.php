<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoCompras extends Model
{
    public static function findOrCreateById($shopping_cart_id){
    	if($shopping_cart_id){
    		return CarritoCompras::find($shopping_cart_id);
    	}else{
    		return CarritoCompras::create();
    	}
    }

    public function product(){
    	return $this->belongsToMany('App\Product','producto_en_carritos', 'id_producto', 'id_producto');
    }

    public function productsCount(){
    	return $this->product()->count();
    }
}
