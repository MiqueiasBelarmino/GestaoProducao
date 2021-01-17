<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->increments('mat_codigo');
            $table->integer('for_codigo')->unsigned();
            $table->foreign('for_codigo')
                ->references('for_codigo')
                ->on('fornecedores')
                ->onDelete('cascade');
            $table->string('mat_nome',100)->unique();
            $table->string('mat_descricao',200);
            $table->double('mat_custo',10,2);
            $table->text('mat_observacao')->nullable();
            //$table->timestamps();
        });

        // Schema::table('materiais_produtos', function($table)
        // {
        //     //$table->integer('mat_codigo')->change();
		// 	$table->foreign('mat_codigo')
        //         ->references('mat_codigo')
        //         ->on('materiais')
        //         ->onDelete('cascade');
            
        //     /*$table->foreign('proc_codigo','p_c')
        //             ->references('proc_codigo')
        //             ->on('processos')
        //             ->onDelete('cascade');
        //     $table->foreign('ped_codigo','o_c')
        //         ->references('ped_codigo')
        //         ->on('pedidos')
        //         ->onDelete('cascade');*/
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiais');
    }
}
