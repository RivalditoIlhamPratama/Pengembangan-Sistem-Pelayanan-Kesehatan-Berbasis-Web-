<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; // optional, kalau nama model dan tabel beda

    protected $primaryKey = 'idBerita'; // penting!
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['admin_id', 'judulBerita', 'isiBerita', 'gambarBerita', 'tanggalBerita'];

    public function admin()
    {
        return $this->belongsTo(adminpuskesmas::class, 'admin_id', 'idAdmin');
    }
}
