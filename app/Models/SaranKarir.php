<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranKarir extends Model
{
    use HasFactory;

    protected $table = 'saran_karirs';

    protected $fillable = ['hasil_psikotes_id', 'tipe_kepribadian', 'saran'];

    public function hasilPsikotes()
    {
        return $this->belongsTo(HasilPsikotes::class, 'hasil_psikotes_id');
    }
}
