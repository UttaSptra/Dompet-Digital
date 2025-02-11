<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'amount',
        'status',
    ];

    // Relasi ke pengguna (pengirim)
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // Relasi ke pengguna (penerima)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}