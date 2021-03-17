<?php

use Illuminate\Database\Seeder;
use App\Models\Processo;
use App\User;

class ProcessosTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Processo::create([
         'proc_nome'        => 'Artes',
         // 'mat_observacao'  => 1,
      ]);

      Processo::create([
         'proc_nome'        => 'Compra',
         // 'mat_observacao'  => 1,
      ]);

      Processo::create([
         'proc_nome'        => 'Corte',
         // 'mat_observacao'  => 1,
      ]);

      Processo::create([
         'proc_nome'        => 'Costura',
         // 'mat_observacao'  => 1,
      ]);

      Processo::create([
         'proc_nome'        => 'Serigrafia',
         // 'mat_observacao'  => 1,
      ]);

      Processo::create([
         'proc_nome'        => 'Qualidade',
         // 'mat_observacao'  => 1,
      ]);

   }
}
