<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    public $fillable = [
        'ar_title', 'en_title',
        'ar_description', 'en_description',
        'price', 'trainer_ratio', 'is_active', 'is_top_course',
        'trainer_id', 'type', 'subscription_type', 'subscription_long',
        'image'
    ];

    public function trainer () {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function categories () {
        return $this->belongsToMany(CourseCategory::class, 'courses_categories', 'course_id', 'course_category_id');
    }

    public function lessions () {
        return $this->hasMany(CourseLession::class, 'course_id');
    }
    
    public function subscriptions () {
        return $this->hasMany(CourseSubscription::class, 'course_id');
    }

    // START FILTRATION; Keep in the end of the model !
    public function scopeAdminFilter(Builder $query) {
        if (request()->filled('name')) {
            $term = request()->query('name');

            $query->where(function ($q) use ($term) {
                $q->orWhere('ar_title', 'like', '%' . $term . '%');
                $q->orWhere('en_title', 'like', '%' . $term . '%');
            });
        }

        if (request()->filled('trainers')) {
            $query->whereIn('trainer_id', request()->query('trainers'));
        }

        if (request()->filled('categories')) {
            $term = request()->query('categories');
            
            $query->wherehas('categories', function ($q) use ($term) {
                $q->whereIn('course_categories.id', $term);
            });
        }

        if (request()->filled('grades')) {
            $query->whereIn('track_grade_id', request()->query('grades'));
        }

        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }
    }

}
