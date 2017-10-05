<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'descripcion' => 'Producto'
        ]);

        DB::table('categorias')->insert([
            'descripcion' => 'Licencia'
        ]);

        DB::table('categorias')->insert([
            'descripcion' => 'Servicio'
        ]);
    }
}
