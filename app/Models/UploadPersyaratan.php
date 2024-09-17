<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPersyaratan extends Model
{
    use HasFactory;

    protected $table = "upload_persyaratan";

    protected $fillable = [
        'mutasi_id',
        'persyaratan_id',
        'user_id',
        'file_path',
        'status_verifikasi',
    ];

    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class);
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
