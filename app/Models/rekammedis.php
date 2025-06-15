<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekammedis extends Model
{
    use HasFactory;

    protected $primaryKey = 'idRekamMedis';

    public $timestamps = false;

    protected $fillable = ['Klinik_id', 'StaffRm_id', 'Dokter_id', 'noRm', 'namaPasien', 'alamatPasien', 'jenisKelamin', 'usiaPasien', 'agamaPasien', 'statusNikah', 'NIK', 'tanggalPeriksa', 'tekananDarah', 'rr', 'nadi', 'suhu', 'tinggiBadan', 'beratBadan', 'riwayatPenyakit', 'diagnosaMedis', 'tindakan', 'resepObat', 'rujukan', 'alasanRujukan'];

    public function staffrekammedis()
    {
        return $this->belongsTo(Staffrekammedis::class, 'StaffRm_id', 'idStaffRm');
    }
    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'Klinik_id', 'idKlinik');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'Dokter_id', 'idDokter');
    }
    public function laporan()
    {
        return $this->hasOne(\App\Models\laporan::class, 'RekamMedis_id', 'idRekamMedis');
    }
}
