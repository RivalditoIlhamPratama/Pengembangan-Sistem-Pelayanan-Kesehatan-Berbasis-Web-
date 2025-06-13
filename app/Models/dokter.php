<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    use HasFactory;

    protected $primaryKey = 'idDokter';

    protected $fillable = ['user_id', 'namaDokter', 'spesialis', 'jenisKelamin', 'tglLahir', 'noTelepon', 'alamatDokter', 'gambarProfil'];


    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class, 'Dokter_id', 'idDokter');
    }

    public function jadwaldokters()
    {
        return $this->hasMany(jadwaldokter::class, 'Dokter_id', 'idDokter');
    }
}
