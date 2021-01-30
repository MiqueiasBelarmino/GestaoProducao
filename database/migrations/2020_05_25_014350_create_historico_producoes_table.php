<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoProducoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_producoes', function (Blueprint $table) {
            $table->integer('his_pro_codigo')->unsigned();
			$table->integer('ped_codigo')->index('fk_ped_idx')->unsigned();
			$table->integer('proc_codigo')->index('fk_proc_idx')->unsigned();
			$table->date('his_pro_data_entrada')->nullable();
			$table->date('his_pro_data_saida')->nullable();
			$table->text('his_pro_observacao')->nullable();
			$table->primary(['his_pro_codigo','ped_codigo','proc_codigo'],'pk_his');
            /*$table->integer('his_pro_codigo')->unsigned();
            $table->integer('ped_codigo')->unsigned();
            $table->integer('proc_codigo')->unsigned();

            $table->primary(['his_pro_codigo','ped_codigo','proc_codigo'], 'pk_his_pro');
            
            
            $table->date('his_pro_data_entrada');
            $table->date('his_pro_data_saida');
            $table->text('ped_observacao');
            //$table->timestamps();*/
        });
        Schema::table('historico_producoes', function($table)
        {
            $table->increments('his_pro_codigo')->change();
			$table->foreign('ped_codigo', 'fk_ped')->references('ped_codigo')->on('pedidos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			// $table->foreign('proc_codigo', 'fk_proc')->references('proc_codigo')->on('processos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('proc_codigo', 'fk_proc')->references('proc_codigo')->on('processos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            /*$table->foreign('proc_codigo','p_c')
                    ->references('proc_codigo')
                    ->on('processos')
                    ->onDelete('cascade');
            $table->foreign('ped_codigo','o_c')
                ->references('ped_codigo')
                ->on('pedidos')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historico_producoes', function (Blueprint $table) {
            $table->dropForeign(['ped_codigo','proc_codigo']);
        });
        Schema::dropIfExists('historico_producoes');
    }
}
