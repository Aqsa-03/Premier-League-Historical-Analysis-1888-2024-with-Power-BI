<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssgUpload extends Model
{
    use HasFactory;

    protected $fillable = ['comment','file','sub_date_time','assignment_id','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
