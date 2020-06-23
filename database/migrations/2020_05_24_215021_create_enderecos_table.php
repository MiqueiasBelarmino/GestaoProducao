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
            $table->string('end_rua',50);
            $table->integer('end_numero');
            $table->string('end_bairro',50);
            $table->string('end_cidade',80);
            $table->string('end_estado',80);
            $table->string('end_cep',8);
            $table->text('end_observacao')->nullable();
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
        Schema::dropIfExists('enderecos');
    }
}
