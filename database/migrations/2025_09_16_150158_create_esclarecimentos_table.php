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
        Schema::create('esclarecimentos', function (Blueprint $table) {
            $table->id();
            $table->date('carga')->nullable();
            $table->date('entrega_judicial')->nullable();
            $table->bigInteger('processo_id');
            $table->string('advogado')->nullable();
            $table->longText('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esclarecimentos');
    }
};
