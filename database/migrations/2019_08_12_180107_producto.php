<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_producto')->index();
            $table->string('Nombre_Producto');
            $table->string('Descripcion')->nullable();
            $table->bigInteger('Precio')->default(0);
            $table->bigInteger('Existencia')->default(0);
            $table->string('image_url')->nullable();
            $table->bigInteger('id_categoria')->unsigned();
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria_producto');
            $table->timestamps();

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
