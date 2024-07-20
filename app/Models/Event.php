<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_title',
        'en_title',
        'day',
        'date',
        'price',
        'location',
        'image',
        'festival_id',
        'is_active',
    ];
    public function festival()
    {
        return $this->belongsTo(Festival::class,'festival_id');
    }
    public function branch()
    {
        return $this->hasMany(Branch::class,'event_id');
    }
    public function scopeAdminFilter($query) {
        if (request()->filled('name')) {
            $query->where(function($q) {
                $q->orWhere('ar_title', 'like', '%' . request()->query('name') . '%');
                $q->orWhere('en_title', 'like', '%' . request()->query('name') . '%');
            });
        }
    
        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }
    
        return $query;
    }
}
