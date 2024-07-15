<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_name',
        'en_name',
    ];
    public function news()
    {
        return $this->hasMany(News::class,'news_category_id');
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
