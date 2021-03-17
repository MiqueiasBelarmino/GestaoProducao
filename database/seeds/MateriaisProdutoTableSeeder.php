<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialProduto;

class MateriaisProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        MaterialProduto::create([
            'mat_codigo'   => 10,
            'prod_codigo'   => 1,
            'mat_pro_valor' => 6,
            'mat_pro_quantidade' => '0.2'
        ]);

        MaterialProduto::create([
            'mat_codigo'   => 11,
            'prod_codigo'   => 2,
            'mat_pro_valor' => 6,
            'mat_pro_quantidade' => '0.2'
        ]);
    }
}
