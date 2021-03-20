<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->integer('com_codigo')->unsigned();
            $table->integer('mat_codigo')->unsigned();
            $table->primary(['com_codigo', 'mat_codigo']);

            $table->foreign('mat_codigo')
                ->references('mat_codigo')
                ->on('materiais')
                ->onDelete('cascade');
            $table->double('com_total', 10, 2)->default(0);
            $table->date('com_data')->nullable();
            $table->date('com_data_vencimento')->nullable();
            $table->date('com_data_pagamento')->nullable();
        });
        Schema::table('compras', function ($table) {
            $table->increments('com_codigo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['mat_codigo']);
        });
        Schema::dropIfExists('compras');
    }
}
