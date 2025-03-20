<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPsikotes extends Model
{
    use HasFactory;

    protected $table = 'hasil_psikotes';
    
    protected $fillable = [
        'user_id', 'jenis_tes', 'hasil', 'big_five'
    ];

    protected $casts = [
        'big_five' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saranKarir()
    {
        return $this->hasOne(SaranKarir::class, 'hasil_psikotes_id');
    }
}
