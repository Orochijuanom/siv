<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'descripcion' => 'Abierta'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Finalizada'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Cancelada'
        ]);
    }
}
