<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(NegociosTableSeeder::class);
        $this->call(TipousersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MonedasTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(VentaformasTableSeeder::class);
        $this->call(OportunidadesTableSeeder::Class);
    }
}
