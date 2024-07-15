<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    public $fillable = [
        'ar_name',
        'en_name',
        'ar_descrption',
        'en_descrption',
        'is_active'
    ];

    public function trainers () {
        return $this->belongsToMany(Trainer::class, 'trainers_specialties', 'course_category_id', 'user_id');
    }

    public function students () {
        return $this->belongsToMany(Student::class, 'students_preferences', 'course_category_id', 'user_id');
    }

    public function courses () {
        return $this->belongsToMany(Course::class, 'courses_categories', 'course_category_id', 'course_id');
    }

    public function scopeAdminFilter(Builder $query) {
        if (request()->filled('name')) {
            $query->where(function($q) {
                $q->orWhere('ar_name', 'like', '%' . request()->query('name') . '%');
                $q->orWhere('en_name', 'like', '%' . request()->query('name') . '%');
            });
        }

        if (request()->filled('is_active')) {
            $query->where('is_active', request()->query('is_active'));
        }
    }

}
