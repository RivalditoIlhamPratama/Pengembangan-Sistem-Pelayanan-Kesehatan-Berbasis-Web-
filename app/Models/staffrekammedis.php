<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffrekammedis extends Model
{
    use HasFactory;

    protected $primaryKey = 'idStaffRm'; // ✅ Tambahkan ini!
    
    protected $fillable = ['namaStaff','jenisKelamin','noHp','alamatStaff','email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function rekammedis()
    {
        return $this->hasMany(Rekammedis::class, 'idStaffRm', 'StaffRm_id');
    }
}
