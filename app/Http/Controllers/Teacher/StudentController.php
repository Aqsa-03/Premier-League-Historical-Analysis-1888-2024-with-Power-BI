<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Allotment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id', $user->teacher->id)->with('classCourse.students.user')->get();
        $students = $allotments->flatMap(function ($allotment) {
            return $allotment->classCourse->students;
        });
        
        return view('teacher.student.list', compact('students'));
    }
}
