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
        Schema::create('soal_mbti', function (Blueprint $table) {
        $table->id();
        $table->string('pertanyaan');
        $table->enum('dimensi', ['Ekstrovert vs Introvert', 'Sensing vs Intuition', 'Thinking vs Feeling', 'Judging vs Perceiving']);
        $table->string('pilihan_a', 50); 
        $table->string('pilihan_b', 50);
        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_mbti');
    }
};
