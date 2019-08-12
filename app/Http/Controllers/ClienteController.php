<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
     public function vistaRegistrarCliente()
    {
    	return view('Cliente.NuevoCliente');
    }
     public function RegistrarCliente($nombre="",$ap="",$am="",$direccion="",$correo="",$tel="",$contra="",$t_us=""){
    	//dd("Nombre: ".$nombre." Apellido: ".$ap."  Ape Materno: ".$am." Direccion  ".$direccion." Correo:  ".$correo." Telefono:   ".$tel." Contaseña: ".$contra." Tipo de usuario:  ".$t_us);
    	$contras=Hash::make($contra);

    	$Considencias =  DB::select('select * from 
                    persona where Correo ="'.$correo.'"');
    	if (count($Considencias) != 0) {
    		$mensaje="Repetido";
    	}else{
	             DB::table('persona')->insert(
	    				['Nombre' => $nombre, 'A_paterno' => $ap, 'A_materno' => $am, 'Direccion' => $direccion, 'Correo' => $correo, 'Telefono' => $tel, 'Contrasena' => $contras, 'TipoUsuario' => $t_us]);

	         //    if ($t_us == 1) {
	         //        $rol="Administrador";
	         //    }elseif ($t_us == 2) {
	         //         $rol="Cliente";
	         //    }elseif ($t_us == 3) {
	         //         $rol="Nutriologo";
	         //    }elseif ($t_us == 4) {
	         //         $rol="Instructor";
	         //    }elseif ($t_us == 5) {
	         //         $rol="Invitado";
	         //    }     

	         // //$user->assignRole('Administrador');
	         
	         // $user->assignRole($rol);

	    	// DB::update("insert into users value(null,'".$nombre."','".$correo."',null,'".$contras."','".$ap."','".$am."','".$fecha."','".$direccion."',".$tel.",".$t_us.",null,null,null)");
	    	$mensaje="success";
   		}
    	return $mensaje;
    }
    public function ModificarClientevista(){
        $color="";
        $mensaje="sin_mensaje";
        return view('Cliente.ModificarCliente',compact('color','mensaje'));
    }
       public function comboRoles(Request $request) {
        $roles =  DB::select('select * from 
                    roles');
        return $roles;
    }
    public function ConsultaCliente($nom=""){
            //dd($bien."--"."$IDmarca");

        if($nom==""){
             $valor = DB::select('select * from persona');

        }else{
            $valor = DB::select('select * from persona where Nombre like "%'.$nom.'%"');
           if (count($valor)==0) {
            $valor="No hay datos";
            $color = "danger";
           }
            //dd($valor);
        }
         
            return $valor; 

    }
    public function ModificarCliente($id="",$nombre="",$ap="",$am="",$direccion="",$correo="",$tel=""){

         DB::table('persona')
            ->where('Id_persona', $id)
            ->update(['Nombre' => $nombre,'A_paterno' => $ap,'A_materno' => $am,'Direccion' => $direccion,'Telefono' => $tel]);
            return "success";

    }
    public function eliminarCliente($id=""){
              

            DB::table('persona')->where('Id_persona', '=', $id)->delete();
             $mensaje="Dato eliminado correctamente";
                $color="success";
           
            return view('Cliente.ModificarCliente', compact('mensaje','color'));
    }
      public function vistaCliente()
    {
    	  $color="";
        $mensaje="sin_mensaje";
        return view('Cliente.ListaCliente', compact('color','mensaje'));
    }
}
