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
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_processo');
            $table->string('mes_ano')->nullable();
            $table->integer('pasta')->default(0);
            $table->string('vara');
            $table->string('reclamante');
            $table->string('doc_reclamante')->nullable();
            $table->string('status')->default('andamento');
            $table->string('reclamada');
            $table->string('doc_reclamada')->nullable()->nullable();
            $table->date('carga')->nullable();
            $table->date('prazo')->nullable();
            $table->date('laudo_judicial')->nullable();
            $table->bigInteger('equipe_id')->nullable();
            $table->decimal('honorario', 12,2);
            $table->boolean('liquidado')->default(0);
            $table->decimal('calculo_conforme_erro', 12, 2)->nullable();
            $table->longText('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
