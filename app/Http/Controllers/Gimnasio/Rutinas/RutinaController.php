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
    public function vistaVerRutina(){
        $color='danger';
        $mensaje='sin_mensaje';
        return view('Rutinas.VerRutinas',compact("color","mensaje"));
    }
    public function verEditar_Rutinas(){
        $color='danger';
        $mensaje='sin_mensaje';
        return view('Rutinas.EditarEjercicio',compact("color","mensaje"));
    }

    public function cargarComboRutina(){
        $consulta=DB::select('SELECT DISTINCT nombre_rutina FROM rutina ');
        return $consulta;
    }
    public function resultadoComboRutina($selec){
        $consulta=DB::select('SELECT * FROM ejercicio INNER JOIN rutina ON ejercicio.id_ejercicio=rutina.id_ejercicio WHERE rutina.Nombre_rutina="'.$selec.'"');
        return $consulta;
    }

    public function vistaRegistrarEjercicio(){
        $color='danger';
        $mensaje='sin_mensaje';
        return view('Rutinas.NuevoEjercicio',compact("color","mensaje"));
    }
    public function mostrarCardRutina($caja){
        $consulta=DB::select('select * from ejercicio where  Nombre_Ejercicio like"%'.$caja.'%"');
        return $consulta;
    }


    public function registrarRutina(Request $request){
    	$rutina=$request->input('Rutina');
    	$Serie=$request->input('Serie');
    	$Repeticion=$request->input('Repeticion');
    	$Descripcion=$request->input('Descripcion');

    	$file = $request['uploadImg2'];

        $file->move(public_path(). '/images/FotosRutinas/', $rutina . '_'.$Serie.'.jpg');

    	DB::update('insert into ejercicio value(null,"'.$rutina.'","'.$Descripcion.'",'.$Serie.','.$Repeticion.',"'. $rutina . '_'.$Serie .'.jpg")');
		$color='success';
    	$mensaje='La rutina fue agregada correctamente';
    	 return view('Rutinas.NuevoEjercicio')->with(['mensaje' => 'La rutina fue agregada correctamente', 'color' => 'success']);
    }
    public function registrarRutinaLista($id,$nombre){
        DB::update('insert into rutina value(null,'.$id.',"'.$nombre.'")');
    }
}
