<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('saran_karirs', function (Blueprint $table) {
            $table->unsignedBigInteger('hasil_psikotes_id')->nullable()->after('id'); // Tambahkan kolom hasil_psikotes_id
            $table->foreign('hasil_psikotes_id')->references('id')->on('hasil_psikotes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('saran_karirs', function (Blueprint $table) {
            $table->dropForeign(['hasil_psikotes_id']);
            $table->dropColumn('hasil_psikotes_id');
        });
    }
};
