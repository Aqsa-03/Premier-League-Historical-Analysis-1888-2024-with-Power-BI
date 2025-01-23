<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\StudentAssgUpload;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStudentAssignmentRequest;

class AssignmentController extends Controller
{
    public function index()
    {
        $classCourseId = Auth::user()->student->class_course_id;
        $currentDateTime = now();
        $assignments = Assignment::where('class_course_id', $classCourseId)
        ->where('due_date_time', '>', $currentDateTime)
        ->doesntHave('studentUploads', 'and', function ($query) {
            $query->where('student_id', Auth::user()->student->id);
        })
        ->get();

        return view('student.assignment.list',compact('assignments'));

    }

    public function show(Request $request)
    {
        $assignmentId = $request->assignment;
        $assignment = Assignment::where('id', $assignmentId)
            ->first();
        return view('student.assignment.view',compact('assignment'));

    }

    public function store(StoreStudentAssignmentRequest $request)
    {
        $authUser = Auth::user()->student->id;
        $validatedData = $request->validated();
        $dueDateTime = Assignment::where('id',$validatedData['assignment_id'])->select(['due_date_time'])->first();
        $dueDateTime = $dueDateTime->due_date_time;
        $currentDateTime  = now()->toDateTimeString();
        
        if($dueDateTime <= $currentDateTime){
            return response()->json(['success' => false]);
        }
        if($request->hasFile('file'))
        {
            $validatedData['file'] = Helper::uploadFile($request->file);
        }
        if(StudentAssgUpload::create($validatedData + ['sub_date_time' => $currentDateTime,'student_id'=>$authUser])){
            return response()->json(['success' => true]);
        }
        $assignmentId = $request->assignment;
        $assignment = Assignment::where('id', $assignmentId)
            ->first();
        return view('student.assignment.view',compact('assignment'));

    }
}
