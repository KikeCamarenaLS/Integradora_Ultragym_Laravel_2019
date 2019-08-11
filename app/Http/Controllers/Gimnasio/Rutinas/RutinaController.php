<?php

namespace App\Http\Controllers\Gimnasio\Rutinas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;

class RutinaController extends Controller
{
    public function vistaRegistrarRutina(){
    	$color='danger';
    	$mensaje='sin_mensaje';
    	return view('Rutinas.NuevaRutina',compact("color","mensaje"));
    }
    public function vistaRegistrarEjercicio(){
        $color='danger';
        $mensaje='sin_mensaje';
        return view('Rutinas.NuevoEjercicio',compact("color","mensaje"));
    }
    public function mostrarCardRutina($caja){
        $consulta=DB::select('select * from rutina where  Nombre_Rutina like"%'.$caja.'%"');
        return $consulta;
    }


    public function registrarRutina(Request $request){
    	$rutina=$request->input('Rutina');
    	$Serie=$request->input('Serie');
    	$Repeticion=$request->input('Repeticion');
    	$Descripcion=$request->input('Descripcion');

    	$file = $request['uploadImg2'];

        $file->move(public_path(). '/images/FotosRutinas/', $rutina . '_'.$Serie.'.jpg');

    	DB::update('insert into rutina value(null,"'.$rutina.'","'.$Descripcion.'",'.$Serie.','.$Repeticion.',"'. $rutina . '_'.$Serie .'.jpg")');
		$color='success';
    	$mensaje='La rutina fue agregada correctamente';
    	 return view('Rutinas.NuevaRutina')->with(['mensaje' => 'La rutina fue agregada correctamente', 'color' => 'success']);
    }
}
