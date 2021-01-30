<?php

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::create([
            'car_nome'         => 'Administrador',
            'car_salario_base' => 2500,
            'car_observacao'   => 'Administrar os processos e recursos da empresa',
        ]);

        Cargo::create([
            'car_nome'         => 'Serigrafista',
            'car_salario_base' => 1500,
            'car_observacao'   => 'Estampar os produtos',
        ]);

        Cargo::create([
            'car_nome'         => 'Costureira',
            'car_salario_base' => 1500,
            'car_observacao'   => 'Costurar os produtos',
        ]);
    }
}
