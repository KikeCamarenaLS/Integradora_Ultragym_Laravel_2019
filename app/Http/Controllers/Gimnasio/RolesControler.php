<?php

namespace App\Http\Controllers\Gimnasio;

use Illuminate\Http\Request;

class RolesControler extends Controller
{

    public function vistaRoles()
    {
    	return view('Roles.roles');
    }
}
