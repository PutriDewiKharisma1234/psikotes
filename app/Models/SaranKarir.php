<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranKarir extends Model
{
    use HasFactory;

    protected $fillable = ['tipe_kepribadian', 'saran'];
}
