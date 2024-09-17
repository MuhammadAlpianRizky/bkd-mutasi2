<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;

    protected $table = "validasi";

    protected $fillable = [
        'mutasi_id',
        'sk_cpns_verified',
        // other fields
    ];

    // Define the relationship with Mutasi
    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class);
    }
}
