<?php

use Illuminate\Database\Seeder;

class NegociosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('negocios')->insert([
            'descripcion' => 'Negocio de prueba'
        ]);
    }
}
