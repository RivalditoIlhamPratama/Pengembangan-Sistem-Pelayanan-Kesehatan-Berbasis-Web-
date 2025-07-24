<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu extends Model
{
    use HasFactory;

    protected $primaryKey = 'idWaktu';

    public $timestamps = false;

    protected $fillable = ['jamMulai', 'jamSelesai'];

    public function jadwal()
    {
        return $this->hasMany(jadwaldokter::class, 'Waktu_id', 'idWaktu');
    }
}