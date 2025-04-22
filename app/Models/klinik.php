<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class klinik extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =['user_id','namaKlinik','alamatKlinik','email'];

    public function user(){
        return $this->belongsTo(user::class,'user_id','id_user');
    }
    public function laporan(){
        return $this->hasMany(laporan::class,'idKlinik','Klinik_id');
    }
}
