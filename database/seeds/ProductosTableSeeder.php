<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'nparte' => '1',
            'fabricante' => 'hp',
            'descripcion' => 'pc i7',
            'estado' => 1,
            'categoria_id' => 1,
            'negocio_id' => 1,
        ]);

        DB::table('productos')->insert([
            'nparte' => '2',
            'fabricante' => 'hp',
            'descripcion' => 'pc i5',
            'estado' => 1,
            'categoria_id' => 1,
            'negocio_id' => 1,
        ]);
    }
}
