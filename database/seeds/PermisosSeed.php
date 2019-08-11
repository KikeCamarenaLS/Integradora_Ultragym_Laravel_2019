<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisosInstructor = ['VerTienda' , 'GestionarAvances', 'ConsultarRutina', 'GestionarRutinas', 'VerPaquetes', 'Comprar'];

        $role = Role::find(4);
        for($i=0; $i< count($permisosInstructor) ;$i++){
            $role->givePermissionTo($permisosInstructor[$i]);
        }

        /* Role Nutriologo  */
        $permisosNutriolog = ['VerPaquetes', 'Comprar','VerTienda' , 'GestionarDietas', 'ConsultarDieta', 'GestionarSalud', 'ConsultarAvanceSalud' ];

        $roleNutriologo = Role::find(3);

        for($i=0; $i< count($permisosNutriolog) ;$i++){
            $roleNutriologo->givePermissionTo($permisosNutriolog[$i]);
        }
        /* Rol Cliente */

        $permisosCliente = ['VerPaquetes', 'Comprar','VerTienda' ,  'ConsultarDieta',  'ConsultarAvanceSalud', 'ConsultarAvances', 'VerPersonal','ConsultarRutina'];

        $roleCliente = Role::find(2);

        for($i=0; $i< count($permisosCliente) ;$i++){
            $roleCliente->givePermissionTo($permisosCliente[$i]);

        }

        /* Invitado */

        $rolInvitado = Role::find(5);

        $permisosInvitado = ['VerPaquetes' , 'VerTienda'];

        for($i =0; $i< count($permisosInvitado); $i++){
            $rolInvitado->givePermissionTo($permisosInvitado[$i]);
        }



    }
}
