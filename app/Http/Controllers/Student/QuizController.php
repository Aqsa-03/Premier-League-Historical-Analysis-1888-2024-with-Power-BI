<?php

namespace App\Http\Controllers\Student;

use App\Models\Quiz;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\StudentQuizUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStudentQuizRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classCourseId = Auth::user()->student->class_course_id;
        $currentDateTime = now();
        $quizzes = Quiz::where('class_course_id', $classCourseId)
        ->where('due_date_time', '>', $currentDateTime)
        ->doesntHave('studentUploads', 'and', function ($query) {
            $query->where('student_id', Auth::user()->student->id);
        })
        ->get();

        return view('student.quiz.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentQuizRequest $request)
    {
        $authUser = Auth::user()->student->id;
        $validatedData = $request->validated();
        $dueDateTime = Quiz::where('id',$validatedData['quiz_id'])->select(['due_date_time'])->first();
        $dueDateTime = $dueDateTime->due_date_time;
        $currentDateTime  = now()->toDateTimeString();
        
        if($dueDateTime <= $currentDateTime){
            return response()->json(['success' => false]);
        }
        if($request->hasFile('file'))
        {
            $validatedData['file'] = Helper::uploadFile($request->file);
        }
        if(StudentQuizUpload::create($validatedData + ['sub_date_time' => $currentDateTime, 'student_id' => $authUser])){
            return response()->json(['success' => true]);
        }
        $assignmentId = $request->assignment;
        $assignment = Quiz::where('id', $assignmentId)
            ->first();
        return view('student.assignment.view',compact('assignment'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $quizId = $request->quiz;
        $quiz = Quiz::where('id', $quizId)
            ->first();
        return view('student.quiz.view',compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
