<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminpuskesmas extends Model
{
    use HasFactory;

    protected $table = 'adminpuskesmas'; // pastikan nama tabel sesuai
    protected $primaryKey = 'idAdmin';   // 👉 tambahkan ini

    public $timestamps = false; // jika tabel tidak punya created_at & updated_at


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