<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackGrade extends Model
{
    use HasFactory;

    public $fillable = [
        'ar_title',
        'en_title',
        'from',
        'to',
        'image',
        'is_active'
    ];

    public function tracks () {
        return $this->hasMany(Track::class, 'grade_id');
    }

    public function groups () {
        return $this->hasMany(GradeGroup::class, 'grade_id');
    }

    public function pricingPlans () {
        return $this->hasMany(TrackGradePricing::class, 'grade_id');
    }

    public function scopeAdminFilter(Builder $query) {
        if (request()->filled('title')) {
            $query->where(function($q) {
                $q->orWhere('ar_title', 'like', '%' . request()->query('title') . '%');
                $q->orWhere('en_title', 'like', '%' . request()->query('title') . '%');
            });
        }

        if (request()->filled('from')) {
            $query->where(function($q) {
                $q->orWhere('from', '>=', request()->query('from'));
            });
        }

        if (request()->filled('to')) {
            $query->where(function($q) {
                $q->orWhere('to', '<=', request()->query('to'));
            });
        }

        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }
    }
}
