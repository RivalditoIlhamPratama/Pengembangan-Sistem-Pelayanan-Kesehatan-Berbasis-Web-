<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu extends Model
{
    use HasFactory;

    protected $fillable =['jamMulai','jamSelesai'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'idDokter');
    }
}