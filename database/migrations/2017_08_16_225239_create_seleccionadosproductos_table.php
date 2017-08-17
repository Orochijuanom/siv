<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeleccionadosproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seleccionadosproductos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cotizadoproducto_id')->unsigned();
            $table->integer('cotizacione_id')->unsigned();
            $table->string('valor_venta');
            $table->string('cantidad');
            $table->date('fecha_entrega');
            $table->date('forma_entrega');
            $table->integer('ventaforma_id')->unsigned();
            $table->string('impuesto')->nullable();
            $table->date('hasta');
            $table->timestamps();

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
        Schema::dropIfExists('seleccionadosproductos');
    }
}
