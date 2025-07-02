<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwaldokter extends Model
{
    use HasFactory;

    protected $primaryKey = 'idJadwal';

    protected $fillable = ['Hari_id', 'Waktu_id', 'Dokter_id'];

    public $timestamps = false;

    public function dokter()
    {
        return $this->belongsTo(dokter::class, 'Dokter_id', 'idDokter');
    }

    public function hari()
    {
        return $this->belongsTo(hari::class, 'Hari_id', 'idHari');
    }

    public function waktu()
    {
        return $this->belongsTo(waktu::class, 'Waktu_id', 'idWaktu');
    }
}
