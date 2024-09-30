<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
// User.php Model Update
    protected $fillable = [
        'nip',
        'nama_lengkap',
        'alamat_tinggal',
        'no_hp',
        'no_ktp',
        'no_karpeg',
        'email',
        'acc_on',
        'is_approved',
        'photo_ktp',
        'photo_karpeg',
        'status_verifikasi',
    ];

    protected $hidden = [
        'acc_on',  // Updated field
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_approved' => 'boolean',
            'acc_on' => 'hashed',  // Updated field
            'status_verifikasi' => 'boolean',
        ];
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }

    public function uploads()
    {
        return $this->hasMany(UploadPersyaratan::class);
    }
    public function notifWa()
{
    return $this->hasMany(NotifWa::class);
}


}
