<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Allotment;
use App\Models\Assignment;
use Illuminate\Support\Str;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\StudentAssgUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        $assignments = Assignment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.assignment.list',compact('allotments','assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.assignment.index',compact('allotments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($request->file('file'))
        {
            $data['file'] = Helper::uploadFile($request->file);
        }
        if(Assignment::create($data + ['teacher_id' => $teacherId]))
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
    public function edit(Assignment $assignment)
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.assignment.edit',compact('allotments','assignment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($request->file('file'))
        {
            $data['file'] = Helper::updateFile($request->file,$assignment->file);
        }
        if($assignment->update($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        if($assignment->delete())
        {
            return redirect()->back();
        }
    }

    public function getStudentAssignments($id)
    {
        $assignments = StudentAssgUpload::with('student')->where('assignment_id', $id)->get();
        return view('teacher.assignment.submission_list',compact('assignments'));
        }
    }
    