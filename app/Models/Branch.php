<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_name',
        'en_name',
        'image',
        'is_active',
        'event_id',
    ];

    public function places()
    {
        return $this->hasMany(Place::class,'branch_id');
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }

    public function scopeAdminFilter($query) {
        if (request()->filled('name')) {
            $query->where(function($q) {
                $q->orWhere('ar_name', 'like', '%' . request()->query('name') . '%');
                $q->orWhere('en_name', 'like', '%' . request()->query('name') . '%');
            });
        }
    
        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }

        return $query;
    }

}
