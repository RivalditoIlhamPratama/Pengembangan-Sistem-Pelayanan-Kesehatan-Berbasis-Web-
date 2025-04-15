<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu extends Model
{
    use HasFactory;

    protected $fillable =['jamMulai','jamSelesai'];

    public function jadwal(){
        return $this->hasMany(hari::class,'Waktu_id','idWaktu');
    }
}