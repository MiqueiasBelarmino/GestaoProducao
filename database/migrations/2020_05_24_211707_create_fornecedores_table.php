<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('for_codigo');
            $table->string('for_nome_razao_social',100);
            $table->string('for_nome_social_fantasia',100)->nullable();
            $table->string('for_rg_inscricao_estadual',50)->nullable();
            $table->string('for_cpf_cnpj',18)->unique();
            $table->string('for_telefone',18);
            $table->string('for_email',100)->unique();
            $table->text('for_observacao')->nullable();
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
        Schema::dropIfExists('fornecedores');
    }
}
