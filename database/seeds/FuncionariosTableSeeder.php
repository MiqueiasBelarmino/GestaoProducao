<?php

use Illuminate\Database\Seeder;
use App\Models\Funcionario;

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
           'fun_cpf'           => '43490058895',
           'fun_email'         => 'miqueias@gmail.com',
           'car_codigo'        => 1,
           'fun_comissao'      => '10',
           'fun_telefone'      => '(18) 996514709',
           'fun_data_admissao' => 'fun_data_admissao',
           'fun_observacao'    => ' ',
        ]);
    }
}
