<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_clientes', function (Blueprint $table) {
            $table->integer('cli_codigo')->unsigned();
            $table->integer('end_codigo')->unsigned();
            $table->string('end_cli_observacao',200)->nullable();
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
        Schema::dropIfExists('endereco_clientes');
    }
}
