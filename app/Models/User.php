<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'email',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pasien()
    {
        return $this->hasOne(pasien::class, 'user_id', 'id_user');
    }
    public function dokter()
    {
        return $this->hasMany(dokter::class, 'user_id', 'id_user');
    }
    public function stafrekammedis()
    {
        return $this->hasMany(staffrekammedis::class, 'user_id', 'id_user');
    }
    public function admin()
    {
        return $this->hasMany(adminpuskesmas::class, 'user_id', 'id_user');
    }
    public function klinik()
    {
        return $this->hasOne(klinik::class, 'user_id', 'id_user');
    }

    // Accessor to get name according to role
    public function getNameAttribute()
    {
        switch ($this->role) {
            case 'admin':
                return optional($this->admin->first())->namaAdmin ?? 'N/A';
            case 'dokter':
                return optional($this->dokter->first())->namaDokter ?? 'N/A';
            case 'pasien':
                return $this->pasien->namaPasien ?? 'N/A';
            case 'stafrekammedis':
                return optional($this->stafrekammedis->first())->namaStaff ?? 'N/A';
            case 'klinik':
                return optional($this->klinik->first())->namaKlinik ?? 'N/A';
            default:
                return 'N/A';
        }
    }

    // Accessor to get email according to role
    public function getEmailAttribute()
    {
        switch ($this->role) {
            case 'admin':
                return optional($this->admin->first())->email ?? 'N/A';
            case 'dokter':
                return optional($this->dokter->first())->email ?? 'N/A';
            case 'pasien':
                return $this->pasien->email ?? 'N/A';
            case 'stafrekammedis':
                return optional($this->stafrekammedis->first())->email ?? 'N/A';
            case 'klinik':
                return optional($this->klinik->first())->email ?? 'N/A';
            default:
                return 'N/A';
        }
    }
}
