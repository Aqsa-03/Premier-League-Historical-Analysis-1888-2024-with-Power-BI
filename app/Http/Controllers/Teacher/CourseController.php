<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Allotment;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Allotment::where('teacher_id',$user->teacher->id)->with('course')->get();
        
        return view('teacher.course.list',compact('courses'));
    }
}
