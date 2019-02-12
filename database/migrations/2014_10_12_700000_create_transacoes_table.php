<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('plano_id');
            $table->unsignedInteger('status_transacao_id');
            $table->string('titular');
            $table->string('numero_cartao', 19);
            $table->string('ccv', 3);
            $table->string('mes', 2);
            $table->string('ano', 4);
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('plano_id')->references('id')->on('planos');
            $table->foreign('status_transacao_id')->references('id')->on('status_transacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
}
