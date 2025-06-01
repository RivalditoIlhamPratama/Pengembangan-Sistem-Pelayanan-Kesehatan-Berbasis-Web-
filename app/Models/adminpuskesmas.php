<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminpuskesmas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'namaAdmin', 'jenisKelamin', 'noHp', 'alamatAdmin', 'email'];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id_user');
    }

    public function berita()
    {
        return $this->hasMany(berita::class, 'idAdmin', 'admin_id');
    }
}