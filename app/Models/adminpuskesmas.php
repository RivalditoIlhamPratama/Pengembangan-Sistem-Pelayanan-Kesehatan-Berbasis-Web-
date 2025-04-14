<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminpuskesmas extends Model
{
    use HasFactory;

    protected $fillable =['namaAdmin','jenisKelamin','noHp','alamatAdmin','email'];

    public function user(){
        return $this->belongsTo(user::class,'user_id','id_user');
    }
}
