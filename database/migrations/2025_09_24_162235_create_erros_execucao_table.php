<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('erros_execucao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('processo_id');
            $table->string('tipo_erro')->nullable();
            $table->date('data_erro');
            $table->boolean('custo_apoio');
            $table->longText('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erros_execucao');
    }
};
