<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizadosproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizadosproductos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->integer('proveedore_id')->unsigned();
            $table->string('valor');
            $table->integer('moneda_id')->unsigned();
            $table->date('fecha_entrega');
            $table->text('forma_entrega');
            $table->timestamps();

            $table->integer('negocio_id')->unsigned();
            $table->foreign('negocio_id')
                ->references('id')->on('negocios')
                ->onDelete('restrict');

            $table->foreign('producto_id')
                ->references('id')->on('productos')
                ->onDelete('restrict');

            $table->foreign('proveedore_id')
                ->references('id')->on('proveedores')
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
        Schema::dropIfExists('cotizadosproductos');
    }
}
