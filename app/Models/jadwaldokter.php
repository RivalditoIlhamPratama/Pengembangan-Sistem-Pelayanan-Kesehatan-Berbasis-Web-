<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwaldokter extends Model
{
    use HasFactory;

    public function dokter(){
        return $this->belongsTo(hari::class,'Dokter_id','idDokter');
    }
    public function hari(){
        return $this->belongsTo(hari::class,'Hari_id','idHari');
    }
    public function waktu(){
        return $this->belongsTo(hari::class,'Waktu_id','idWaktu');
    }
}
