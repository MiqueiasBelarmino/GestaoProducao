<?php

use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use App\User;

class FuncionariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcionario::create([
            'fun_nome'          => 'Miquéias Belarmino',
            'fun_rg'            => '533631257',
            'fun_cpf'           => '11111111111',
            'fun_email'         => 'miqueias@email.com',
            'car_codigo'        => 1,
            'fun_comissao'      => '10',
            'fun_telefone'      => '(18) 996514709',
            'fun_data_admissao' => now(),
            'fun_senha'         => bcrypt('123456789'),
            //'fun_observacao'    => '',
         ]);
        

    }
}
