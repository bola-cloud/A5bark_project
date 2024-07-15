<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_head',
        'ar_title',
        'ar_content',
        'en_head',
        'en_title',
        'en_content',
        'image',
        'is_active',
        'news_category_id'
    ];

    public function newsCategory() {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
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
