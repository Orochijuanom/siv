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
            'estado_id' => 1,
        ]);
    }
}
