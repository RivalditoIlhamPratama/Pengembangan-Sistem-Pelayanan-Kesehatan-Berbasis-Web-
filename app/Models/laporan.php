<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =['Klinik_id','RekamMedis_id','tanggal','catatanPenyakit','jumlahPasien'];

    public function klinik(){
        return $this->belongsTo(Klinik::class,'Klinik_id','idKlinik');
    }
    public function rekam_medis(){
        return $this->belongsTo(Rekammedis::class,'RekamMedis_id','idRekamMedis');
    }
}