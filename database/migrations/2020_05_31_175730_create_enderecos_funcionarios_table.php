<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos_funcionarios', function (Blueprint $table) {
            $table->integer('fun_codigo')->unsigned();
            $table->integer('end_codigo')->unsigned();
            $table->string('end_cli_observacao',200)->nullable();
            $table->primary(['fun_codigo','end_codigo']);

            $table->foreign('fun_codigo')
                ->references('fun_codigo')
                ->on('funcionarios')
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
        Schema::dropIfExists('enderecos_funcionarios');
    }
}
