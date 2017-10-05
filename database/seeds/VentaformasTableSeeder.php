<?php

use Illuminate\Database\Seeder;

class VentaformasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ventaformas')->insert([
            'descripcion' => 'Contado'
        ]);

        DB::table('ventaformas')->insert([
            'descripcion' => 'Credito'
        ]);
    }
}
