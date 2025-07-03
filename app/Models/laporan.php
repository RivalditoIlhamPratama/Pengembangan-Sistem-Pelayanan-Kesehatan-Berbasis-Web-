<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idLaporan'; // ✅ Tambahkan ini
    public $timestamps = true;

    protected $fillable = [
        'Klinik_id',
        'RekamMedis_id',
        'namaPasien',
        'namaDokter',
        'diagnosaMedis',
        'NIK',
        'alamatPasien',
        'deskripsi_tindakan',
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
