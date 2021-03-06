<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos_clientes', function (Blueprint $table) {
            $table->integer('cli_codigo')->unsigned();
            $table->integer('end_codigo')->unsigned();
            $table->text('end_cli_observacao')->nullable();
            $table->primary(['cli_codigo','end_codigo']);

            $table->foreign('cli_codigo')
                ->references('cli_codigo')
                ->on('clientes')
                ->onDelete('cascade');
            $table->foreign('end_codigo')
                ->references('end_codigo')
                ->on('enderecos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos_clientes', function (Blueprint $table) {
            $table->dropForeign(['cli_codigo','end_codigo']);
        });
        Schema::dropIfExists('enderecos_clientes');
    }
}
