<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform( function($element){
                return [
                    'id_Producto' => $element->id_producto,
                    'Producto' =>$element->Nombre_Producto,
                    'Descripcion' =>$element->Descripcion,
                    'Precio' => "$".($element->Precio),
                    'Existencia' =>$element->Existencia,
                    'imagen' =>$element->image_url,
                    'Id_Categoria' =>$element->id_categoria,
                    'Categoria' =>$element->Categoria,
                ];
            })
        ];
    }
}
