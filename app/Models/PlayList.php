<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_title',
        'en_title',
        'image',
        'sound_link',
        'spotify_link',
        'titok_link',
        'youtube_link',
        'is_active',
    ];
    public function episodes()
    {
        return $this->hasMany(Episode::class,'playlist_id');
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
