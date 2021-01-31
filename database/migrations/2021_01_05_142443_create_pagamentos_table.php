<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->integer('pag_codigo')->unsigned();
            $table->integer('ped_codigo')->unsigned();
            $table->primary(['pag_codigo', 'ped_codigo']);

            $table->foreign('ped_codigo')
                ->references('ped_codigo')
                ->on('pedidos')
                ->onDelete('cascade');
            $table->double('pag_valor', 10, 2)->default(0);
            $table->integer('pag_parcela');
            $table->date('pag_data_vencimento');
            $table->date('pag_data_pagamento');
        });
        Schema::table('pagamentos', function ($table) {
            $table->increments('pag_codigo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->dropForeign(['ped_codigo']);
        });
        Schema::dropIfExists('pagamentos');
    }
}
