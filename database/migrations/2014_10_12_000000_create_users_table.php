<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('tipouser_id')->unisgned();
            $table->integer('negocio_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('tipouser_id')
                ->references('id')->on('tipousers')
                ->onDelete('restrict');
        

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
        Schema::dropIfExists('users');
    }
}
