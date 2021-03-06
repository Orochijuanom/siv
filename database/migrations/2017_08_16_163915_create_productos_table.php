<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nparte');
            $table->string('fabricante');
            $table->string('descripcion');
            $table->boolean('estado');
            $table->timestamps();

            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')
                ->references('id')->on('categorias')
                ->onDelete('restrict');

            $table->integer('negocio_id')->unsigned();
            $table->foreign('negocio_id')
                ->references('id')->on('negocios')
                ->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
