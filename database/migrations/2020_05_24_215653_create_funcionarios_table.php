<?php

use App\Models\Funcionario;
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
            $table->string('fun_nome', 100);
            $table->string('fun_rg', 15);
            $table->string('fun_cpf', 14)->unique();
            $table->string('fun_email', 50);
            $table->integer('car_codigo')->unsigned();
            $table->foreign('car_codigo')
                ->references('car_codigo')
                ->on('cargos');
            //->onDelete('cascade');
            $table->double('fun_salario', 10,2)->default(0);
            $table->integer('fun_comissao')->unsigned();
            $table->string('fun_telefone', 18);
            $table->date('fun_data_admissao');
            $table->string('fun_senha', 250);
            $table->text('fun_observacao')->nullable();
            $table->rememberToken();
        });
        // Schema::table('pedidos', function ($table) {
        //     //$table->integer('fun_codigo')->change();
        //     $table->foreign('fun_codigo')
        //         ->references('fun_codigo')
        //         ->on('funcionarios')
        //         ->onDelete('cascade');
        // });

        // Schema::table('enderecos_funcionarios', function (Blueprint $table) {
        //     $table->foreign('fun_codigo')
        //         ->references('fun_codigo')
        //         ->on('funcionarios')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropForeign(['car_codigo']);
        });
        Schema::dropIfExists('funcionarios');
    }
}
