<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalMBTI extends Model
{
    use HasFactory;

    protected $table = 'soal_mbti';
    protected $fillable = ['pertanyaan', 'dimensi', 'pilihan_a', 'pilihan_b'];
}
