<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class ListadoRolesControler extends Controller
{
    public function vistaListado()
    {
    	return view('Roles.listadoPersonasRoles');
    }

    public function getListado()
    {
    	$listado = "select us.id AS idUser, us.email , CONCAT(us.NAME,' ', us.apellido_P,' ',us.apellido_M) AS nombreUser, 
					rol.NAME AS Rol, rol.id AS idRol FROM users us inner JOIN model_has_roles mhs ON us.id = mhs.model_id
					INNER JOIN roles rol ON mhs.role_id = rol.id";
		$listadoDB = DB::select($listado);
		return $listadoDB;

    }

    public function diferentesRoles($idRol)
    {
    	$roles = "SELECT id AS id_Rol, name FROM roles WHERE roles.id != ".$idRol;
    	$rolesDB = DB::select($roles);
    	return $rolesDB;
    }

    public function ModificarRol(Request $request){

    	$IdRol = $request->IdNuevoRol;
    	$IdUsuario = $request->IdUsuario;

    	$updateRol = "update model_has_roles SET role_id = ".$IdRol." WHERE model_id = ".$IdUsuario;
    	DB::update($updateRol);
    }

    public function DetallesUsuario($idUsuario){

    	$user = User::where('id',$idUsuario)->get();
    	return $user;
    }
}
