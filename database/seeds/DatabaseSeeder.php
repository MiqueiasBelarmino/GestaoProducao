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
        $this->call(CargosTableSeeder::class);
        $this->call(FuncionariosTableSeeder::class);
        $this->call(FornecedoresTableSeeder::class);
    }
}
