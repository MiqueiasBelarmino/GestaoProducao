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
            $table->integer('ped_codigo')->unsigned();
            $table->primary(['pag_codigo', 'ped_codigo']);

            $table->foreign('ped_codigo')
                ->references('ped_codigo')
                ->on('pedidos')
                ->onDelete('cascade');
            $table->double('com_total', 10, 2)->default(0);
            $table->date('com_data')->nullable();
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
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['ped_codigo']);
            $table->dropForeign(['for_codigo']);
        });
        Schema::dropIfExists('compras');
    }
}
