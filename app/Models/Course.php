<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'course_id', 'name', 'location_id', 'term_id', 'level', 'times', 'students_count', 'term_id', 'group', 'status'];
}
