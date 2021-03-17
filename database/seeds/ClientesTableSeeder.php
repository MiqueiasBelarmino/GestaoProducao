<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\User;

class ClientesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Cliente::create([
         'cli_nome_razao_social'       => 'Carlos Silva',
         'cli_nome_social_fantasia'    => 'Carlos',
         'cli_rg_inscricao_estadual'   => '32541256',
         'cli_cpf_cnpj'                => '111.111.111-11',
         'cli_telefone'                => '(18) 98285-4714',
         'cli_email'                   => 'carlos@email.com',
         'cli_observacao'              => 'Artes'
         // 'mat_observacao'  => 1,
      ]);

      Cliente::create([
         'cli_nome_razao_social'       => 'João Batista',
         'cli_nome_social_fantasia'    => 'Batista',
         'cli_rg_inscricao_estadual'   => '58621475',
         'cli_cpf_cnpj'                => '222.222.222-22',
         'cli_telefone'                => '(18) 93695-5214',
         'cli_email'                   => 'joao@email.com',
         'cli_observacao'              => 'Artes'
         // 'mat_observacao'  => 1,
      ]);

      Cliente::create([
         'cli_nome_razao_social'       => 'Paulo Almeida',
         'cli_nome_social_fantasia'    => 'Paulo',
         'cli_rg_inscricao_estadual'   => '8521475',
         'cli_cpf_cnpj'                => '333.333.333-33',
         'cli_telefone'                => '(18) 99635-5554',
         'cli_email'                   => 'paulo@email.com',
         'cli_observacao'              => 'Artes'
         // 'mat_observacao'  => 1,
      ]);

   }
}
