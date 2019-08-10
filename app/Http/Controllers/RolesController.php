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
    	$roles= Role::orderBy('id')->get();
       // $rolesDB = "select rol.*, per.id AS id_permiso, per.NAME AS Permiso FROM roles rol INNER JOIN role_has_permissions rhs ON rol.id = 
       //                rhs.role_id INNER JOIN permissions per ON rhs.permission_id = per.id";
       // $roles = DB::select($rolesDB);

    	return $roles;


    }

    public function getPermisos(){
        $rolesDB = "select rhs.role_id AS id_rol, per.id AS id_permiso, per.NAME FROM role_has_permissions rhs INNER JOIN permissions per ON 
                    rhs.permission_id = per.id ORDER BY rhs.role_id";
        $permisos = DB::select($rolesDB);
        //$permisos = Permission::orderBy('id')->get();
        return $permisos;
    }

     public function RolesAdministrador(){

        $Administrador = "select rol.id AS ID_ROL , rol.name AS Rol, per.id AS ID_Permiso, per.name AS Permiso
            FROM role_has_permissions rhp LEFT JOIN roles rol ON rhp.role_id = rol.id
            LEFT JOIN permissions per ON rhp.permission_id = per.id where rol.id = 1";
        $resultados = DB::select($Administrador);

        /* SELECT rol.id AS ID_ROL , rol.name AS Rol, per.id AS ID_Permiso, per.name AS Permiso FROM role_has_permissions rhp LEFT JOIN roles rol ON rhp.role_id = rol.id
LEFT JOIN permissions per ON rhp.permission_id = per.id*/

        return $resultados;
    }

    public function UsuariosPorRol($idRol){ //funcion que devuelve al usuario que tiene determinado rol
        //busqueda realizada por id de Rol

        $usuarios = "select us.* FROM model_has_roles mhs LEFT JOIN users us ON mhs.model_id = us.id where mhs.role_id = ".$idRol;
        $UsuariosByRol = DB::select($usuarios);
        return $UsuariosByRol;

    }

    public function PermisosPorRol($idRol){

     $permisos = "select rhs.*, per.NAME AS permiso FROM role_has_permissions rhs LEFT JOIN permissions per ON rhs.permission_id = per.id WHERE rhs.role_id = ".$idRol;
     $PermisoByRol = DB::select($permisos);
     return $PermisoByRol;
    }

    public function RolesDiferentesRol($idUsuario){

        $usuario= "select rol.* FROM roles rol WHERE rol.id != ( select mhs.role_id FROM model_has_roles mhs WHERE mhs.model_id = ".$idUsuario.")";
        $RolesDisponibles = DB::select($usuario);
        return $RolesDisponibles;
    }

}
