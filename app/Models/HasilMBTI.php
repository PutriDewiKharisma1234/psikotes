<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilMBTI extends Model
{
    use HasFactory;

    protected $table = 'hasil_mbti';
    protected $fillable = ['user_id', 'tipe_mbti'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
