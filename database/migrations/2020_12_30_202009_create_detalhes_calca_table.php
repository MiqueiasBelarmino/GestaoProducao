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

            $table->integer('det_cal_passadores')->unsigned();
            $table->integer('det_cal_elastico')->unsigned();
            $table->integer('det_cal_elastico_costas')->unsigned();
            $table->integer('det_cal_bolso_frente')->unsigned();
            $table->integer('det_cal_bolso_costas')->unsigned();
            $table->integer('det_cal_refletiva')->unsigned();

            $table->foreign('prod_codigo')
                ->references('prod_codigo')
                ->on('produtos')
                ->onDelete('cascade');
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
        Schema::dropIfExists('detalhes_calca');
    }
}
