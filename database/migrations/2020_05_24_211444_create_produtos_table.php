<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('prod_codigo');
            $table->string('prod_nome',100)->unique();
            $table->double('prod_valor',10,2);
            $table->text('prod_observacao')->nullable();
            //$table->timestamps();
        });
        // Schema::table('materiais_produtos', function($table)
        // {
        //     //$table->integer('prod_codigo')->change();
		// 	$table->foreign('prod_codigo')
        //         ->references('prod_codigo')
        //         ->on('produtos')
        //         ->onDelete('cascade');
 
        //     /*$table->foreign('proc_codigo','p_c')
        //             ->references('proc_codigo')
        //             ->on('processos')
        //             ->onDelete('cascade');
        //     $table->foreign('ped_codigo','o_c')
        //         ->references('ped_codigo')
        //         ->on('pedidos')
        //         ->onDelete('cascade');*/
        // });

        // Schema::table('item_pedido', function (Blueprint $table){
        //     $table->foreign('prod_codigo')
        //         ->references('prod_codigo')
        //         ->on('produtos')
        //         ->onDelete('cascade');
        // });

        // Schema::table('detalhes_calca', function (Blueprint $table){
        //     $table->foreign('prod_codigo')
        //         ->references('prod_codigo')
        //         ->on('produtos')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
