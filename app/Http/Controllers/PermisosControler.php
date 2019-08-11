<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosControler extends Controller
{
    public function vistaPermisos()
    {

    	return view('Roles.permisos');
    }

    public function getPermisos()
    {
    	 $permisos= Permission::all();
    	 return $permisos;
    }

    public function registroPermisos(Request $request)
    {
    	$permiso = $request->PermisoNuevo;

    	Permission::create(['name' => $permiso]);


 

    }

}
