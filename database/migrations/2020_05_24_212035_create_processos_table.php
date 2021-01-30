<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('proc_codigo');
            $table->string('proc_nome',100);
            $table->text('proc_observacao')->nullable();
            //$table->timestamps();
        });
        // Schema::table('historico_producoes', function($table)
        // {
        //     // $table->increments('his_pro_codigo')->change();
		// 	// $table->foreign('ped_codigo', 'fk_ped')->references('ped_codigo')->on('pedidos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		// 	$table->foreign('proc_codigo', 'fk_proc')->references('proc_codigo')->on('processos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processos');
    }
}
