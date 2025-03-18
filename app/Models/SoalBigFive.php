<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalBigFive extends Model
{
    use HasFactory;

    protected $table = 'soal_big_five';

    protected $fillable = [
        'pertanyaan',
        'dimensi',
        'pilihan_a',
        'pilihan_b'
    ];
}

