<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = "mutasi";

    protected $fillable = [
        'user_id',
        'no_registrasi',
        'nama',
        'nip',
        'pgol',
        'jabatan',
        'unit_kerja',
        'instansi',
        'no_hp',
        'sk_cpns',
        'sk_pns',
        'sk_pangkat_terakhir',
        'sk_jabatan_struktural',
        'sk_jabatan_fungsional',
        'sk_berkala_terakhir',
        'verified',
        'is_final',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function uploads()
    {
        return $this->hasMany(UploadPersyaratan::class);
    }


}
