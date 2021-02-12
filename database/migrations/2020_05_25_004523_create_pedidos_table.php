<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('ped_codigo');
            $table->integer('cli_codigo')->unsigned();
            $table->foreign('cli_codigo')
                ->references('cli_codigo')
                ->on('clientes')
                ->onDelete('cascade');
            $table->integer('fun_codigo')->unsigned();
            $table->foreign('fun_codigo')
                    ->references('fun_codigo')
                    ->on('funcionarios')
                    ->onDelete('cascade');
            $table->double('ped_total',10,2)->default(0);
            $table->date('ped_data');
            $table->date('ped_data_aprovacao')->nullable();
            $table->date('ped_data_entrega');
            $table->string('ped_status_pagamento',30);
            $table->text('ped_observacao')->nullable();
            //$table->timestamps();
        });

        // Schema::table('historico_producoes', function($table)
        // {
        //     // $table->increments('his_pro_codigo')->change();
		// 	$table->foreign('ped_codigo', 'fk_ped')->references('ped_codigo')->on('pedidos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		// 	// $table->foreign('proc_codigo', 'fk_proc')->references('proc_codigo')->on('processos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });
        // Schema::table('item_pedido', function (Blueprint $table){
        //     $table->foreign('ped_codigo')
        //         ->references('ped_codigo')
        //         ->on('pedidos')
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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['cli_codigo','fun_codigo']);
        });
        Schema::dropIfExists('pedidos');
    }
}
