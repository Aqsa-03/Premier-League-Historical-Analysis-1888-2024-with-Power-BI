<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Quiz;
use App\Models\Allotment;
use App\Models\Assignment;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\StudentQuizUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        $quizzes = Quiz::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.quiz.list',compact('allotments','quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.quiz.index',compact('allotments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuizRequest $request)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($request->file('file'))
        {
            $data['file'] = Helper::uploadFile($request->file);
        }
        if(Quiz::create($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.quiz.edit',compact('allotments','quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($request->file('file'))
        {
            $data['file'] = Helper::updateFile($request->file, $quiz->file);
        }
        if($quiz->update($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        if($quiz->delete())
        {
            return redirect()->back();
        }
    }

    public function getStudentQuizzes($id)
    {
        $quizzes = StudentQuizUpload::with('student')->where('quiz_id', $id)->get();
        return view('teacher.quiz.submission_list',compact('quizzes'));
        }
}
