<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekammedis extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['StaffRm_id','Dokter_id', 'noRm', 'namaPasien', 'NIK', 'tanggalPeriksa', 'tekananDarah', 'nadi', 'suhu', 'tinggiBadan', 'beratBadan', 'diagnosaMedis'];

    public function staffrekammedis()
    {
        return $this->belongsTo(Staffrekammedis::class, 'StaffRm_id', 'idStaffRm');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'Dokter_id', 'idDokter');
    }
}