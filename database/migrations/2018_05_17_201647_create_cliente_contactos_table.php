<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('email');
            $table->string('cargo');
            $table->string('telefono');
            $table->timestamps();

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
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
        Schema::dropIfExists('cliente_contactos');
    }
}
