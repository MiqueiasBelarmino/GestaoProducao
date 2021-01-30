<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido', function (Blueprint $table) {
            $table->integer('prod_codigo')->unsigned();
            $table->integer('ped_codigo')->unsigned();
            $table->integer('ite_ped_quantidade')->unsigned();
            $table->string('ite_ped_cor',50)->nullable();
            $table->double('ite_ped_valor',10,2)->default(0);
            $table->text('ite_ped_observacao');
            $table->primary(['prod_codigo','ped_codigo']);

            $table->foreign('prod_codigo')
                ->references('prod_codigo')
                ->on('produtos')
                ->onDelete('cascade');
            $table->foreign('ped_codigo')
                ->references('ped_codigo')
                ->on('pedidos')
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
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->dropForeign(['prod_codigo','ped_codigo']);
        });
        Schema::dropIfExists('itens_pedido');
    }
}
