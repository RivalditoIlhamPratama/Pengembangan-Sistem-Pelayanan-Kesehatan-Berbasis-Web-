<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'from_id',
        'to_id',
        'pesan',
    ];

    // Relasi ke User (pengirim)
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'from_id', 'id_user');
    }

    // Relasi ke User (penerima)
    public function penerima()
    {
        return $this->belongsTo(User::class, 'to_id', 'id_user');
    }
}
