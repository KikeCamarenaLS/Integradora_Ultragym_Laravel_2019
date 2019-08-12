<?php

use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = ['Ropa', 'Consumibles', 'Accesorios', 'Equipo', 'Aparatos', 'Otros'];

        for($i =0; $i< count($tipos); $i++){
        	DB::table('categoria_producto')->insert([
        		'Categoria' => $tipos[$i],
        	]);
        }
    }
}
