<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oportunidade_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->string('version');
            $table->integer('moneda_id')->unsigned();
            $table->string('descuento');
            $table->boolean('showdescuento');
            $table->timestamps();

            $table->foreign('oportunidade_id')
                ->references('id')->on('oportunidades')
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
        Schema::dropIfExists('cotizaciones');
    }
}
