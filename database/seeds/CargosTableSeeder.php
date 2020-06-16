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
            'car_descricao'    => 'Administrar os processos e recursos da empresa',
            'car_salario_base' => 2500,
            'car_observacao'   => ' ',
        ]);
    }
}
