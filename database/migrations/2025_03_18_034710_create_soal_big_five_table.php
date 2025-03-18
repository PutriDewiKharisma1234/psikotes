<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal_big_five', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->enum('dimensi', ['Openness', 'Conscientiousness', 'Extraversion', 'Agreeableness', 'Neuroticism']);
            $table->string('pilihan_a', 50);
            $table->string('pilihan_b', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal_big_five');
    }
};

