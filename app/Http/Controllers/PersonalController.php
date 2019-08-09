<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PersonalController extends Controller
{
      public function vistaRegistrarPersonal()
    {
    	return view('Personal.NuevaPersona');
    }
    public function RegistrarPersonal($nombre="",$ap="",$am="",$direccion="",$correo="",$tel="",$contra="",$t_us,$fecha=""){
    	//$contras=Hash::make($contra);

    	$Considencias =  DB::select('select * from 
                    users where email ="'.$correo.'"');
    	if (count($Considencias) != 0) {
    		$mensaje="Repetido";
    	}else{
             $user = User::create([
            'name' => $nombre,
            'email' => $correo,
            'password' => Hash::make($contra),
            'apellido_P' => $ap,
            'apellido_M' => $am,
            'fecha_nacimiento' => $fecha,
            'direccion' => $direccion,
            'telefono' => $tel,
            'id_tipo_usuario' =>$t_us,

        ]);

            if ($t_us == 1) {
                $rol="Administrador";
            }elseif ($t_us == 2) {
                 $rol="Cliente";
            }elseif ($t_us == 3) {
                 $rol="Nutriologo";
            }elseif ($t_us == 4) {
                 $rol="Instructor";
            }elseif ($t_us == 5) {
                 $rol="Invitado";
            }     

         //$user->assignRole('Administrador');
         
         $user->assignRole($rol);

	    	// DB::update("insert into users value(null,'".$nombre."','".$correo."',null,'".$contras."','".$ap."','".$am."','".$fecha."','".$direccion."',".$tel.",".$t_us.",null,null,null)");
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
        $color="";
        $mensaje="sin_mensaje";
        return view('Personal.ModificarPersonal',compact('color','mensaje'));
    }
    public function ConsultaPersonal($nom=""){
            //dd($bien."--"."$IDmarca");

        if($nom==""){
             $valor = DB::select('select * from users');

        }else{
            $valor = DB::select('select * from users where name like "%'.$nom.'%"');
                
           
           if (count($valor)==0) {
            $valor="No hay datos";
            $color = "danger";
           }
            //dd($valor);
        }
         
            return $valor; 

    }
    public function ModificarPersona($id="",$nombre="",$ap="",$am="",$direccion="",$correo="",$tel="",$fecha=""){

         DB::table('users')
            ->where('id', $id)
            ->update(['name' => $nombre,'apellido_P' => $ap,'apellido_M' => $am,'fecha_nacimiento' => $fecha,'direccion' => $direccion,'telefono' => $tel]);
            return "success";

    }
    public function eliminarPersonal($id=""){
              

            DB::table('users')->where('id', '=', $id)->delete();
             $mensaje="Dato eliminado correctamente";
                $color="success";
           
            return view('Personal.ModificarPersonal', compact('mensaje','color'));
    }
      public function vistaPersonal()
    {
        return view('Personal.ListaPersonal');
    }
    
 
}
