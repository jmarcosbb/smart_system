<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id(); // Coluna de ID auto-incremental
            $table->string('tipo_fluxo'); // 'embarque', 'nao-embarcar', 'deixar-passageiro'
            $table->string('horario')->nullable(); // Horário escolhido, pode ser nulo
            $table->string('categoria_embarque')->nullable(); // 'com-passagem', etc. Pode ser nulo
            $table->integer('quantidade_pessoas'); // Quantidade de pessoas
            $table->string('codigo_barras')->nullable(); // Código de barras gerado, pode ser nulo
            $table->timestamps(); // Cria as colunas `created_at` e `updated_at` automaticamente
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
