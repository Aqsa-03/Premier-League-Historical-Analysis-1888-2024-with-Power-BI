<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','file','teacher_id','course_id','class_course_id','due_date_time'];
    public function classCourse()
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function studentUploads()
    {
        return $this->hasMany(StudentAssgUpload::class, 'assignment_id', 'id');
    }
}
