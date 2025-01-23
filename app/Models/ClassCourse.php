<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    use HasFactory;

    protected $fillable = ['name','department_id','semester_id','section_id'];

    public function students()
    {
        return $this->hasMany(Student::class,'class_course_id','id');
    }
}
