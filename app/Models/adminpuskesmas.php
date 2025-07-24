<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminpuskesmas extends Model
{
    use HasFactory;

    protected $table = 'adminpuskesmas';
    protected $primaryKey = 'idAdmin';
    public $timestamps = false;

    protected $fillable = ['user_id', 'namaAdmin', 'jenisKelamin', 'noHp', 'alamatAdmin', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // default Laravel
    }

    public function berita()
    {
        return $this->hasMany(berita::class, 'admin_id', 'idAdmin'); // sudah benar
    }
}
