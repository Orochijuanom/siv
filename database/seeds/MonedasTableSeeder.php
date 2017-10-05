<?php

use Illuminate\Database\Seeder;

class MonedasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monedas')->insert([
            'descripcion' => 'Peso',
            'siglas' => 'COP',
            'simbolo' => '$'
        ]);

        DB::table('monedas')->insert([
            'descripcion' => 'Dolar',
            'siglas' => 'USD',
            'simbolo' => '$'
        ]);

        DB::table('monedas')->insert([
            'descripcion' => 'Euro',
            'siglas' => 'EUR',
            'simbolo' => '€'
        ]);
    }
}
