<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoEnCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_en_carritos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger("id_producto")->unsigned();
            $table->foreign("id_producto")->references("id")->on("producto");

            $table->bigInteger("id_carrito_compras")->unsigned();
            $table->foreign("id_carrito_compras")->references("id")->on("carrito_compras");

            $table->integer("amount")->default(1);

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
        Schema::dropIfExists('producto_en_carritos');
    }
}
