<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifWa extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'notif_wa';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'mutasi_id',
        'status',
        'nama',
        'nip',
        'no_hp',
        'no_registrasi',
    ];

    /**
     * Get the user associated with the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the mutasi associated with the notification.
     */
    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class);
    }
}
