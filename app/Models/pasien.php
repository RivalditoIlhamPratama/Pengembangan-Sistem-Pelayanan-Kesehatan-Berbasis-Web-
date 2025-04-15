<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'namaPasien', 'jenisKelamin', 'noHp', 'alamatPasien', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function pengaduan(){
        return $this->hasMany(pengaduan::class, 'idPasien', 'Pasien_id');
    }
}