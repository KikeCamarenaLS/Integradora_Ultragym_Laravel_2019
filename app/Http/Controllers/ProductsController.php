<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Schema;
use Illuminate\Support\Facades\DB;

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
        $IdCategoria = $request->IdTipo;

        $fecha = date("Y-m-d_h_i_s");
        $NombreFoto = $fecha."_".$IdCategoria."_".$NombreProduct."_".$PrecioProduct.".jpg";

        $product = new Product();

        $product->Nombre_Producto = $NombreProduct;
        $product->Descripcion = $DescripcionProduct;
        $product->Precio = $PrecioProduct;
        $product->image_url = $NombreFoto;
        $product->id_categoria = $IdCategoria;

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

    public function indexProductsEdit()
    {
        return view('Productos.productoEdit');
    }

    public function getProductos()
    {
        $consulta = "select pr.id_producto, pr.Nombre_Producto, pr.Descripcion, pr.Precio, pr.Existencia, cp.Categoria, pr.image_url
                    , cp.id_categoria from producto pr INNER JOIN categoria_producto cp ON pr.id_categoria = cp.id_categoria";
        $producto = DB::select($consulta);
        return $producto;
    }

    public function getProductosJSON()
    {
        $consulta = "select pr.id_producto, pr.Nombre_Producto, pr.Descripcion, pr.Precio, pr.Existencia, cp.Categoria,
                    cp.id_categoria from producto pr INNER JOIN categoria_producto cp ON pr.id_categoria = cp.id_categoria";
        $producto = DB::select($consulta);
        return json_encode($producto);
    }

    public function getTipos()
    {
        $consulta = "select * from categoria_producto";
        $Tipo = DB::select($consulta);
        return $Tipo;
    }

    public function getTiposDiscard($id)
    {
        $consulta = "select * from categoria_producto where id_categoria != ".$id;
        $Tipo = DB::select($consulta);
        return $Tipo;
    }

    public function editarProducto(Request $request){

        $NombreProduct = $request->NombreProducto;
        $DescripcionProduct = $request->DescripcionProducto ;
        $PrecioProduct = $request->PrecioProducto ;
        $IdCategoria = $request->IdTipo;
        $Existencia = $request->ExistenciaProduct;
        $IdProducto = $request->IdProducto;

        $acualizar = "update producto set Nombre_Producto = '".$NombreProduct." ', Descripcion = '".$DescripcionProduct."' , Precio = ".$PrecioProduct." ,Existencia =  ".$Existencia." , id_categoria = ".$IdCategoria." where id_producto = ".$IdProducto;
        DB::update($acualizar);

    }

    public function busquedaByName($nombre){


        $consulta = "select pr.id_producto, pr.Nombre_Producto, pr.Descripcion, pr.Precio, pr.Existencia, cp.Categoria, pr.image_url
                    , cp.id_categoria from producto pr INNER JOIN categoria_producto cp ON pr.id_categoria = cp.id_categoria where pr.Nombre_Producto = '".$nombre."'";
        $producto = DB::select($consulta);
        return $producto;
    }
}
