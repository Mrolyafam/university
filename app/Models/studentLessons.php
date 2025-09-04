<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studentLessons extends Model
{
    protected $fillable = ['stu_id', 'term', 'midd_lesson_id', 'unit', 'midd_teacher_id'];
}
