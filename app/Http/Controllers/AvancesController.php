<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
}
