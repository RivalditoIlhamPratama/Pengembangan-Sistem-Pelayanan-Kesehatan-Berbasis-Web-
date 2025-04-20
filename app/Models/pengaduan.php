<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPengaduan';
    protected $fillable = [
        'Pasien_id',
        'isiPengaduan',
        'jenisPengaduan',
        'phone',
        'gambarPengaduan'
    ];

    public function pasien()
    {
        return $this->belongsTo(\App\Models\pasien::class, 'Pasien_id', 'idPasien');
    }
}
