<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
      public function vistaRegistrarPersonal()
    {
    	return view('Personal.NuevaPersona');
    }
    public function RegistrarPersonal($nombre="",$ap="",$am="",$direccion="",$correo="",$tel="",$contra="",$t_us,$fecha=""){
    	$contras=Hash::make($contra);

    	$Considencias =  DB::select('select * from 
                    users where email ="'.$correo.'"');
    	if (count($Considencias) != 0) {
    		$mensaje="Repetido";
    	}else{
	    	DB::update("insert into users value(null,'".$nombre."','".$correo."',null,'".$contras."','".$ap."','".$am."','".$fecha."','".$direccion."',".$tel.",".$t_us.",null,null,null)");
	    	$mensaje="success";
   		}
    	return $mensaje;
    }
      public function comboRoles(Request $request) {
        $roles =  DB::select('select * from 
                    roles');
        return $roles;
    }

    public function ModificarPersonalvista(){
        return view('Personal.ModificarPersonal');
    }
    public function ConsultaPersonal($nom){
            //dd($bien."--"."$IDmarca");
                $valor = DB::select('select * from users where name like "%'.$nom.'%"');
                
           
           if (count($valor)==0) {
            $valor="No hay datos";
            $color = "danger";
           }
            //dd($valor);
            return $valor; 

    }
    public function ModificarPersona($id="",$nombre="",$ap="",$am="",$direccion="",$correo="",$tel="",$fecha=""){

         DB::table('users')
            ->where('id', $id)
            ->update(['name' => $nombre,'apellido_P' => $ap,'apellido_M' => $am,'fecha_nacimiento' => $fecha,'direccion' => $direccion,'telefono' => $tel]);
            return "success";

    }
 
}
