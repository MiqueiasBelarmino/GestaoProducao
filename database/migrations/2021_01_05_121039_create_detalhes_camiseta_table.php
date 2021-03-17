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

            $table->integer('det_cam_manga_tipo');
            $table->integer('det_cam_manga_tamanho');
            $table->string('det_cam_manga_cor',100);
            $table->integer('det_cam_manga_galao');
            $table->integer('det_cam_gola_tipo');
            $table->integer('det_cam_gola_decote');
            $table->integer('det_cam_bolso_frente');

            $table->foreign('prod_codigo')
                ->references('prod_codigo')
                ->on('produtos')
                ->onDelete('cascade');
            //$table->timestamps();
        });

        Schema::table('detalhes_camiseta', function($table)
        {
            $table->increments('det_cam_codigo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalhes_camiseta', function (Blueprint $table) {
            $table->dropForeign(['prod_codigo']);
        });
        Schema::dropIfExists('detalhes_camiseta');
    }
}
