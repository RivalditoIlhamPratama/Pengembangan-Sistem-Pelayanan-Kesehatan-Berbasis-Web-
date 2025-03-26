<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    use HasFactory;

    protected $fillable =['namaPasien','jenisKelamin','noHp','alamatPasien','email'];

    public function akunpengguna()
    {
        return $this->belongsTo(user::class, 'id_user', 'idPasien');
    }
}