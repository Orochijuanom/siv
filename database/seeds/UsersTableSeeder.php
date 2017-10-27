<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'tipouser_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Administrador del negocio',
            'email' => 'admin@negocio.com',
            'password' => bcrypt('123456'),
            'tipouser_id' => 2,
            'negocio_id' => 1
        ]);
    }
}
