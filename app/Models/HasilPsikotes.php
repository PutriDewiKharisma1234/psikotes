<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPsikotes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'jenis_tes', 'hasil'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

