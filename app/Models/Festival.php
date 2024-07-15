<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;
    protected $fillable = [
        'media',
        'start_date',
        'location',
        'ar_title',
        'en_title',
        'is_active'
    ];
    public function events()
    {
        return $this->hasMany(Event::class,'festival_id');
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
