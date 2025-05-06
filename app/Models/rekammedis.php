<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekammedis extends Model
{
    use HasFactory;

    protected $primaryKey = 'idRekamMedis';

    public $timestamps = false;

    protected $fillable = ['StaffRm_id','Dokter_id', 'noRm', 'namaPasien','agamaPasien','statusPernikahan','alamatPasien','jenisKelamin', 'NIK', 'tanggalPeriksa', 'tekananDarah','usiaPasien','rr', 'nadi', 'suhu', 'tinggiBadan', 'beratBadan', 'riwayatPenyakit' , 'resepObat','resepObat', 'diagnosaMedis'];

    public function staffrekammedis()
    {
        return $this->belongsTo(Staffrekammedis::class, 'StaffRm_id', 'idStaffRm');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'Dokter_id', 'idDokter');
    }
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'idRekamMedis', 'RekamMedis_id');
    }
}