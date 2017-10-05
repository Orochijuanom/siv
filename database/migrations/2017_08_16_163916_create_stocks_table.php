<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->boolean('estado');
            $table->bigInteger('valor');
            $table->date('fecha_entrega');
            $table->text('forma_entrega');
            $table->timestamps();

            $table->foreign('categoria_id')
            ->references('id')->on('categorias')
            ->onDelete('restrict');

            $table->foreign('producto_id')
            ->references('id')->on('productos')
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
        Schema::dropIfExists('stocks');
    }
}
