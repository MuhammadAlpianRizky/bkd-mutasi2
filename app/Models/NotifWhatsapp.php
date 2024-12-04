<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifWhatsapp extends Model
{
    use HasFactory;

    protected $table = 'notif_whatsapp';

    // Mass assignable attributes
    protected $fillable = [
        'id',
        'no_hp',
        'message',
        'is_sent'
    ];

    /**
     * Mutator untuk memformat nomor telepon agar diawali dengan '62' jika diawali dengan '0'.
     */
    public function setNoHpAttribute($value)
    {
        // Cek apakah nomor diawali dengan '0', lalu ganti dengan '62'
        if (substr($value, 0, 1) == '0') {
            $value = '62' . substr($value, 1); // Ganti 0 dengan 62
        }

        // Menyimpan nomor telepon yang sudah diformat
        $this->attributes['no_hp'] = $value;
    }
}
