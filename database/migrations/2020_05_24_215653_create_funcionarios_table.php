<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('fun_codigo');
            $table->string('fun_nome',80);
            $table->string('fun_rg',15);
            $table->string('fun_cpf',14)->unique();
            $table->string('fun_email',50);
            $table->integer('car_codigo')->unsigned();
            $table->foreign('car_codigo')
                ->references('car_codigo')
                ->on('cargos')
                ->onDelete('cascade');
            $table->integer('fun_comissao')->unsigned();
            $table->string('fun_telefone',18);
            $table->date('fun_data_admissao');
            $table->string('fun_senha',250);
            $table->text('fun_observacao')->nullable();
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
        Schema::dropIfExists('funcionarios');
    }
}
