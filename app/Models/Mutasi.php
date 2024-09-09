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
        'verified',
        'is_final',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Method to validate the mutasi
    public function validate()
    {
        $this->update([
            'verified' => true,
            'verified_at' => now(),
        ]);
    }
}
