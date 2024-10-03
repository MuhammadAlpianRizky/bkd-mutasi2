<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;
    protected $table = "undangan";

    protected $fillable=[
    'user_id',
    'mutasi_id',
    'kode_undangan',
    'file'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class);
    }
}
