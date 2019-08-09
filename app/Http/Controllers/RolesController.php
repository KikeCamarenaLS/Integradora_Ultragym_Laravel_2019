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

class RolesController extends Controller
{
    public function vistaRoles()
    {

    	return view('Roles.roles');
    }

    public function getRoles()
    {
    	$roles= Role::all();
    	return $roles;

    	$consultaroles = 'select per.name, rol.name from permissions per leftjoin role_has_permissions rhs on per.id = rhs.permission_id
    				      leftjoin roles r on rhs.role_id = r.id';
    }

     public function RolesAdministrador(){

        $Administrador = "select rol.id AS ID_ROL , rol.name AS Rol, per.id AS ID_Permiso, per.name AS Permiso
            FROM role_has_permissions rhp LEFT JOIN roles rol ON rhp.role_id = rol.id
            LEFT JOIN permissions per ON rhp.permission_id = per.id where rol.id = 1";
        $resultados = DB::select($Administrador);

        return $resultados;
    }

}
