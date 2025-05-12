<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hari extends Model
{
    use HasFactory;

    protected $primaryKey = 'idHari';

    public $timestamps = false;

    protected $fillable = ['namaHari'];

    public function jadwal()
    {
        return $this->hasMany(jadwaldokter::class, 'Hari_id', 'idHari');
    }
}