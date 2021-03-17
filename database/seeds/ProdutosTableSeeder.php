<?php

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::create([
            'prod_nome'  => 'Calça Brim Leve',
            'prod_valor' => 6.0,
        ]);

        Produto::create([
            'prod_nome'  => 'Calça Brim Pesado',
            'prod_valor' => 6.0,
        ]);

    }
}
