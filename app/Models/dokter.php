<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    use HasFactory;

    protected $fillable =['namaDokter','spesialis','jenisKelamin','jadwalPraktek','tglLahir','alamatDokter'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function rekammedis(){
        return $this->hasMany(Rekammedis::class, 'idDokter', 'Dokter_id');
    }
}
