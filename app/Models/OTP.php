<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'user_id', 'uuid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
