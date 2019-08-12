<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        return view('Productos.producto', ["product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Almacenar en la BD nuevos recursos

        $NombreProduct = $request->NombreProducto;
        $DescripcionProduct = $request->DescripcionProducto ;
        $PrecioProduct = $request->PrecioProducto ;

        $fecha = date("Y-m-d_h_i_s");
        $NombreFoto = $fecha."_".$NombreProduct."_".$PrecioProduct.".jpg";

        $product = new Product();

        $product->Nombre_Producto = $NombreProduct;
        $product->Descripcion = $DescripcionProduct;
        $product->Precio = $PrecioProduct;
        $product->image_url = $NombreFoto;

        $product->save();

        //Product::create($options);

        $file = $request->file('Imagen');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/images/Productos/',$NombreFoto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $NombreProduct = $request->NombreProducto;
        $DescripcionProduct = $request->DescripcionProducto ;
        $PrecioProduct = $request->PrecioProducto ;

        $fecha = date("Y-m-d_h_i_s");
        $NombreFoto = $fecha."_".$NombreProduct."_".$PrecioProduct.".jpg";




        $options = [
            'Nombre_Producto' => $request->NombreProducto,
            'Descripcion' => $request->DescripcionProducto,
            'Precio' => $request->PrecioProducto,
            //'image_url' => $NombreFoto
        ];

        Product::create($options);

        $file = $request->file('Imagen');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/images/Productos/',$NombreFoto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id_producto', $id)->get();
        //return $product;
        return view("Productos.productoEdit",["product" => $product ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
