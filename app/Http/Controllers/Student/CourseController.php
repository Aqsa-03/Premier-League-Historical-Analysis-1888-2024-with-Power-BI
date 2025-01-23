<?php

namespace App\Http\Controllers\Student;

use App\Models\Allotment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    
    public function show()
    {
        $classCourseId = Auth::user()->student->class_course_id;
        $courses = Allotment::where('class_course_id',$classCourseId)->with('course')->get();
        return view('student.course.list',compact('courses'));
    }

}
