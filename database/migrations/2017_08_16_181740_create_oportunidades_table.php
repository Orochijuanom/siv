<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOportunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->string('solicitante');
            $table->string('email');
            $table->string('cargo');
            $table->string('telefono');
            $table->string('empresa');
            $table->string('nit')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->datetime('fecha_requerida');
            $table->datetime('fecha_atencion')->nullable();
            $table->bigInteger('presupuesto');
            $table->integer('moneda_id')->unsigned();
            $table->text('observaciones')->nullable();
            $table->integer('negocio_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            
            $table->timestamps();

            
            $table->foreign('negocio_id')
                ->references('id')->on('negocios')
                ->onDelete('restrict');

            $table->foreign('estado_id')
                  ->references('id')->on('estados')
                  ->onDelete('restrict');

                
            $table->foreign('moneda_id')
                ->references('id')->on('monedas')
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
        Schema::dropIfExists('oportunidades');
    }
}
