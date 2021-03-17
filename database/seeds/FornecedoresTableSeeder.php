<?php

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fornecedor::create([
            'for_nome_razao_social'     => 'Amarildo da Silva Tintas',
            'for_nome_social_fantasia'  => 'Tintas Amarildo',
            'for_rg_inscricao_estadual' => 'ISENTO',
            'for_cpf_cnpj'              => '74554189000109',
            'for_telefone'              => '(18) 996514709',
            'for_email'                 => 'amarildo@email.com',
            'for_observacao'            => 'pagar sempre em 15 dias',
         ]);

         Fornecedor::create([
            'for_nome_razao_social'     => 'Malhas São José',
            'for_nome_social_fantasia'  => 'Malhas São José',
            'for_rg_inscricao_estadual' => 'ISENTO',
            'for_cpf_cnpj'              => '74554189000108',
            'for_telefone'              => '(18) 996514708',
            'for_email'                 => 'malhas@email.com',
            //'for_observacao'            => 'pagar sempre em 15 dias',
         ]);

         Fornecedor::create([
            'for_nome_razao_social'     => 'Capelini Malhas e Tecidos',
            'for_nome_social_fantasia'  => 'Capelini Malhas',
            'for_rg_inscricao_estadual' => 'ISENTO',
            'for_cpf_cnpj'              => '66527425000161',
            'for_telefone'              => '(15) 997311618',
            'for_email'                 => 'administracao@capelinimalhas.com.br',
            'for_observacao'            => 'fechamento mensal',
         ]);

    }
}
