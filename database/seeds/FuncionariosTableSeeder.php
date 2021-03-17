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
            'fun_cpf'           => '334.910.580-95',
            'fun_email'         => 'miqueias@email.com',
            'car_codigo'        => 1,
            'fun_comissao'      => '10',
            'fun_telefone'      => '(18) 996514709',
            'fun_data_admissao' => now(),
            'fun_senha'         => bcrypt('123456789'),
            //'fun_observacao'    => '',
         ]);

         Funcionario::create([
            'fun_nome'          => 'José Aparecido',
            'fun_rg'            => '533631258',
            'fun_cpf'           => '433.900.588-96',
            'fun_email'         => 'jose@email.com',
            'car_codigo'        => 2,
            'fun_comissao'      => '10',
            'fun_telefone'      => '(18) 996514708',
            'fun_data_admissao' => now(),
            'fun_senha'         => bcrypt('123456789'),
            //'fun_observacao'    => '',
         ]);

         Funcionario::create([
            'fun_nome'          => 'Tania Costa',
            'fun_rg'            => '533631290',
            'fun_cpf'           => '434.970.362-14',
            'fun_email'         => 'tania@email.com',
            'car_codigo'        => 2,
            'fun_comissao'      => '5',
            'fun_telefone'      => '(18) 996514708',
            'fun_data_admissao' => now(),
            'fun_senha'         => bcrypt('123456789'),
            //'fun_observacao'    => '',
         ]);
        

    }
}
