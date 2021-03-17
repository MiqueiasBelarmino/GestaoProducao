<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalhesCalcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhes_calca', function (Blueprint $table) {
            $table->integer('det_cal_codigo')->unsigned();
            $table->integer('prod_codigo')->unsigned();
            $table->primary(['det_cal_codigo','prod_codigo']);

            $table->integer('det_cal_passadores');
            $table->integer('det_cal_elastico');
            $table->integer('det_cal_bolso_frente');
            $table->integer('det_cal_bolso_costas');
            $table->integer('det_cal_refletiva');

            $table->foreign('prod_codigo')
                ->references('prod_codigo')
                ->on('produtos')
                ->onDelete('cascade');
            //$table->timestamps();
        });

        Schema::table('detalhes_calca', function($table)
        {
            $table->increments('det_cal_codigo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalhes_calca', function (Blueprint $table) {
            $table->dropForeign(['prod_codigo']);
        });
        Schema::dropIfExists('detalhes_calca');
    }
}
