<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'Klinik_id',
        'RekamMedis_id',
        'namaPasien',
        'namaDokter',
        'diagnosaMedis',
        'NIK',
        'alamatPasien',
    ];


    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'Klinik_id', 'idKlinik');
    }
    public function rekam_medis()
    {
        return $this->belongsTo(\App\Models\rekammedis::class, 'RekamMedis_id', 'idRekamMedis');
    }
}
