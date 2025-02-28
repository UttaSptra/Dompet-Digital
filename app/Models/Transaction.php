<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'amount', 'status', 'target_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function targetuser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
