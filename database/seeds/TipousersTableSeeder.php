<?php

use Illuminate\Database\Seeder;

class TipousersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipousers')->insert([
            'descripcion' => 'Administrador'
        ]);

        DB::table('tipousers')->insert([
            'descripcion' => 'Cliente'
        ]);

        DB::table('tipousers')->insert([
            'descripcion' => 'Vendedor'
        ]);
    }
}
