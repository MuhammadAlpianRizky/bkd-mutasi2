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
}
