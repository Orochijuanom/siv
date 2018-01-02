<?php

use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            'nombre' => 'proveedor',
            'empresa' => 'empresa',
            'telefono' => '311263',
            'email' => 'email@email.com',
            'nit' => '22322',
            'negocio_id' => 1,
        ]);
    }
}
