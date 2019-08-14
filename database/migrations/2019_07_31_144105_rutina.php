<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rutina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_ejercicio')->index();
            $table->string('Nombre_Ejercicio');
            $table->string('Descripcion');
            $table->bigInteger('Serie');
            $table->bigInteger('Repeticiones');
            $table->string('Imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
