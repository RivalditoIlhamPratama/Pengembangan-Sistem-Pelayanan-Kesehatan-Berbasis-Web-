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

    // Removed rekam_medis relation because RekamMedis_id column was dropped
}
