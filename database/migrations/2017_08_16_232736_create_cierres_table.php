<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cotizacione_id')->unsigned();
            $table->integer('ventaforma_id')->unsigned();
            $table->string('porcentaje');
            $table->date('fecha_facturacion');
            $table->timestamps();

            $table->foreign('cotizacione_id')
                ->references('id')->on('cotizaciones')
                ->onDelete('restrict');

            $table->foreign('ventaforma_id')
                ->references('id')->on('ventaformas')
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
        Schema::dropIfExists('cierres');
    }
}
