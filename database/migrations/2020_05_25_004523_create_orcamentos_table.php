<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('orc_codigo');
            $table->integer('cli_codigo')->unsigned();
            $table->foreign('cli_codigo')
                ->references('cli_codigo')
                ->on('clientes')
                ->onDelete('cascade');
            $table->integer('fun_codigo')->unsigned();
            $table->foreign('fun_codigo')
                    ->references('fun_codigo')
                    ->on('funcionarios')
                    ->onDelete('cascade');
            $table->double('orc_total',10,2)->default(0);
            $table->date('orc_data_abertura');
            $table->date('orc_data_entrega');
            $table->string('orc_status',30);
            $table->text('orc_observacao');
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
        Schema::dropIfExists('orcamentos');
    }
}
