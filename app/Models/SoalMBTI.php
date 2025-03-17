<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalMBTI extends Model
{
    use HasFactory;

    protected $table = 'soal_mbti'; // Nama tabel di database

    protected $fillable = [
        'pertanyaan',
        'tipe'
    ];
}
