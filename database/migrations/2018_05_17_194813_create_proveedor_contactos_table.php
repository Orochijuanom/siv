<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('email');
            $table->string('cargo');
            $table->string('telefono');
            $table->timestamps();

            $table->integer('proveedore_id')->unsigned();
            $table->foreign('proveedore_id')
                ->references('id')->on('proveedores')
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
        Schema::dropIfExists('proveedor_contactos');
    }
}
