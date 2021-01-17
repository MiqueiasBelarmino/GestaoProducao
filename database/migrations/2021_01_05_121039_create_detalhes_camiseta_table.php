<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalhesCamisetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhes_camiseta', function (Blueprint $table) {
            $table->integer('det_cam_codigo')->unsigned();
            $table->integer('prod_codigo')->unsigned();
            $table->primary(['det_cam_codigo','prod_codigo']);

            $table->integer('det_cam_manga_tipo')->unsigned();
            $table->integer('det_cam_manga_tamanho')->unsigned();
            $table->integer('det_cam_manga_cor')->unsigned();
            $table->integer('det_cam_manga_galao')->unsigned();
            $table->integer('det_cam_gola_tipo')->unsigned();
            $table->integer('det_cam_gola_decote')->unsigned();
            $table->integer('det_cam_bolso_frente')->unsigned();

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
        Schema::dropIfExists('detalhes_camiseta');
    }
}
