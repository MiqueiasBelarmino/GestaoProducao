<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('cli_codigo');
            $table->string('cli_nome_razao_social',200);
            $table->string('cli_nome_social_fantasia',200)->nullable();
            $table->string('cli_rg_inscricao_estadual',50)->nullable();
            $table->string('cli_cpf_cnpj',18)->unique();
            $table->string('cli_telefone',18);
            $table->string('cli_email',80)->unique();
            $table->text('cli_observacao')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
