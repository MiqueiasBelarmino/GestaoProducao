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
            $table->text('mat_observacao');
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
        Schema::dropIfExists('materiais');
    }
}
