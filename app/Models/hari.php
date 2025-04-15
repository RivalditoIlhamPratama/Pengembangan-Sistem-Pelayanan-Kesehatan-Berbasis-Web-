<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hari extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =['namaHari'];

    public function jadwal(){
        return $this->hasMany(hari::class,'Hari_id','idHari');
    }
}
