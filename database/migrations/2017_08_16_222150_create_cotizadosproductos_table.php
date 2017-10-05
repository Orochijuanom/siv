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
            $table->integer('stock_id')->unsigned();
            $table->bigInteger('valor');
            $table->integer('cotizacione_id')->unsigned();
            $table->integer('moneda_id')->unsigned();
            $table->date('fecha_entrega');
            $table->text('forma_entrega');
            $table->timestamps();
            
            $table->foreign('stock_id')
                ->references('id')->on('stocks')
                ->onDelete('restrict');

            $table->foreign('cotizacione_id')
            ->references('id')->on('cotizaciones')
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
