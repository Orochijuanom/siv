<?php

use Illuminate\Database\Seeder;

class OportunidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oportunidades')->insert([
            'descripcion' => 'Descripción de la cotización',
            'solicitante' => 'Nombre del solicitante',
            'email' => 'Email@Email.com',
            'cargo' => 'cargo',
            'telefono' => '123456789',
            'empresa' => 'Empresa',
            'nit' => '12313112',
            'fecha_requerida' => '2017-1-1 00:00:00',
            'presupuesto' => '200000',
            'moneda_id' => 1,
            'negocio_id' => 1,
        ]);

        DB::table('oportunidades')->insert([
            'descripcion' => 'Descripción de la cotización 2',
            'solicitante' => 'Nombre del solicitante 2',
            'email' => 'Email@Email2.com',
            'cargo' => 'cargo2',
            'telefono' => '123456789',
            'empresa' => 'Empresa2',
            'nit' => '12313112',
            'fecha_requerida' => '2017-1-1 00:00:00',
            'presupuesto' => '2000000',
            'moneda_id' => 1,
            'negocio_id' => 1,
        ]);
    }
}
