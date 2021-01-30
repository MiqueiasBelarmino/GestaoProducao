<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_produtos', function (Blueprint $table) {
            $table->integer('mat_codigo')->unsigned();
            $table->integer('prod_codigo')->unsigned();
            $table->double('mat_pro_valor', 10, 2)->default(0);
            // $table->double('mat_prod_rendimento',10,2);
            $table->integer('mat_pro_quantidade')->unsigned();
            $table->primary(['mat_codigo', 'prod_codigo']);
            
            $table->foreign('prod_codigo')
                ->references('prod_codigo')
                ->on('produtos')
                ->onDelete('cascade');
            $table->foreign('mat_codigo')
                ->references('mat_codigo')
                ->on('materiais')
                ->onDelete('cascade');
            // $table->foreign('ped_codigo')
            //     ->references('ped_codigo')
            //     ->on('pedidos')
            //     ->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materiais', function (Blueprint $table) {
            $table->dropForeign(['prod_codigo','mat_codigo']);
        });
        Schema::dropIfExists('material_produtos');
    }
}
