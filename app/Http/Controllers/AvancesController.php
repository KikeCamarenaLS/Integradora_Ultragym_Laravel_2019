<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class AvancesController extends Controller
{
    public function VistaAvances(){
    	return view('Avances.RegistrarAvances');
    }
    public function RegistrarAvance($id="",$peso="",$altura="",$imc="",$pgb="",$pga="",$pgp=""){
    	//dd($id.$peso.$altura.$imc.$pgb.$pga.$pgp);

    	DB::update("insert into historialsalud value(null,".$id.",".$peso.",".$altura.",".$pgb.",".$pga.",".$pgp.",now(),".$imc.")");
    	$mensaje="success";
    	return $mensaje;

    }
    public function VistaCAvances(){
    	return view('Avances.ConsultarAvances');
    }

    public function ConsultaAvances($id=""){
    	$avances = DB::select('select * from 
                    historialsalud where id_persona ='.$id.'');
    	return $avances;

    }
    public function VistaMisAvances(){
        return view('Avances.MisAvances');

    }

    public function ConsultaMisAvances(){
        $id = Auth::id();
        $avances = DB::select('select * from 
                    historialsalud where id_persona ='.$id.'');
        return $avances;
    }
}
