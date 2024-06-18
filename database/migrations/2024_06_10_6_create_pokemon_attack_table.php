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
        Schema::create('pokemon_attack', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pokemon_id')->constrained('pokemons')->onDelete('cascade');
            $table->foreignId('attack_id')->constrained('attacks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_attack');
    }
};
