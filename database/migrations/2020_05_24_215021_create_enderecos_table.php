<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('end_codigo');
            $table->string('end_rua',100);
            $table->integer('end_numero');
            $table->string('end_bairro',100);
            $table->string('end_cidade',100);
            $table->string('end_estado',100);
            $table->string('end_cep',8);
            $table->text('end_observacao')->nullable();
            //$table->timestamps();
        });
        // Schema::table('enderecos_clientes',function (Blueprint $table){
        //     $table->foreign('end_codigo')
        //         ->references('end_codigo')
        //         ->on('enderecos')
        //         ->onDelete('cascade');
        // });
        // Schema::table('enderecos_funcionarios',function (Blueprint $table){
        //     $table->foreign('end_codigo')
        //         ->references('end_codigo')
        //         ->on('enderecos')
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
        Schema::dropIfExists('enderecos');
    }
}
