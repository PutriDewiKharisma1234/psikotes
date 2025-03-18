<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saran_karirs', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kepribadian'); // MBTI atau Big Five
            $table->text('saran'); // Saran karir yang sesuai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saran_karirs');
    }
};
