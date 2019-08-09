<?php

namespace App\Http\Controllers\Gimnasio;

use Illuminate\Http\Request;


class RolesControler extends Controller
{

    public function vistaRoles()
    {
    	return view('Roles.roles');
    }

    public function RolesAdministrador(){

    	$Administrador = "select rol.id AS ID_ROL , rol.name AS Rol, per.id AS ID_Permiso, per.name AS Permiso
    		FROM role_has_permissions rhp LEFT JOIN roles rol ON rhp.role_id = rol.id
			LEFT JOIN permissions per ON rhp.permission_id = per.id where rol.id = 1";
		$resultados = DB::select($Administrador);

		return $resultados;
    }
}
