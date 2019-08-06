<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaqueteController extends Controller
{
     public function vistaRegistrarPaquete()
    {
        $mensaje="sin_mensaje";
        $color="danger";
    	return view('Paquetes.NuevoPaquete',compact('color','mensaje'));
    }
    public function RegistrarPaquete(Request $request){
        $file = $request['uploadImg2'];
        $nombre=$request->input('Paquete');
        $descripcion=$request->input('Descripcion');
        $costo=$request->input('Costo');

        $file->move(public_path(). '/images/FotosPaquetes/', $nombre . '_'.$descripcion.'.jpg');
    	DB::update("insert into paquete value(null,'".$nombre."','".$descripcion."',".$costo.",'".$nombre . '_'.$descripcion.".jpg')");
        $color="success";
        $mensaje="Paquete registrado correctamente";
    	return view('Paquetes.NuevoPaquete',compact('color','mensaje'));
    }
    public function ListadoPaquetes(){
    	return view('Paquetes.ListadoPaquetes');
    }
    public function mostrarTablaPersona(){
    	$paquete=DB::select("select * from paquete");
    	return $paquete;

    }
    public function eliminarTablaPaquetes($id){
    	$eliminar=DB::update("delete from paquete where id_paquete=".$id);
    	return $eliminar;
    }
    public function modificarpaquete($id,$nombre,$descripcion,$costo){
	$eliminar=DB::update("update paquete set Paquete='".$nombre."',descripcion='".$descripcion."',Costo='".$costo."' where id_paquete=".$id);
    	return $eliminar;
    }
    public function ListadoPaquetesUsuario(){
    	return view('Paquetes.ConsultaPaquetes');
    }
}
