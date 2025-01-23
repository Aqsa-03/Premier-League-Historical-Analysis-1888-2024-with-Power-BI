<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizUpload extends Model
{
    use HasFactory;

    protected $fillable = ['comment','file','sub_date_time','quiz_id','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
