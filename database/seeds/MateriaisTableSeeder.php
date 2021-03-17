<?php

use Illuminate\Database\Seeder;
use App\Models\Material;

class MateriaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'for_codigo'      => 1,
            'mat_unidade'     => 'Lata',
            'mat_nome'        => 'Tinta silco Branco',
            'mat_custo'       => '10',
            // 'mat_observacao'  => 1,
         ]);
         Material::create([
            'for_codigo'      => 1,
            'mat_unidade'     => 'Lata',
            'mat_nome'        => 'Tinta silco Azul Royal',
            'mat_custo'       => '12',
            // 'mat_observacao'  => 1,
         ]);
         Material::create([
            'for_codigo'      => 1,
            'mat_unidade'     => 'Lata',
            'mat_nome'        => 'Tinta silco Amarelo',
            'mat_custo'       => '10',
            // 'mat_observacao'  => 1,
         ]);
         Material::create([
            'for_codigo'      => 1,
            'mat_unidade'     => 'Lata',
            'mat_nome'        => 'Tinta silco Verde Limão',
            'mat_custo'       => '10',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'PV Profissional Branco',
            'mat_custo'       => '20',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'PV Azul Marinho',
            'mat_custo'       => '20',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'PV Azul Royal',
            'mat_custo'       => '22',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'PV Preto',
            'mat_custo'       => '20',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'PV Vermelho',
            'mat_custo'       => '20',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'Brim Leve',
            'mat_custo'       => '30',
            // 'mat_observacao'  => 1,
         ]);
   
         Material::create([
            'for_codigo'      => 2,
            'mat_unidade'     => 'Metro',
            'mat_nome'        => 'Brim Pesado',
            'mat_custo'       => '30',
            // 'mat_observacao'  => 1,
         ]);
   
    }
}
