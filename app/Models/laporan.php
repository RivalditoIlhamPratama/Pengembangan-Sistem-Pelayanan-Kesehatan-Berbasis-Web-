<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $fillable =['tanggal','catatanPenyakit','jumlahPasien'];

    public function klinik(){
        return $this->belongsTo(Klinik::class,'Klinik_id','idKlinik');
    }
}
