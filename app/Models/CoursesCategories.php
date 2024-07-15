<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesCategories extends Model
{
    use HasFactory;

    public $fillable = ['course_category_id', 'course_id'];
    
}
