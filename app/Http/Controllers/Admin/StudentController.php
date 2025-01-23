<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassCourse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user','department')->get();
        return view('admin.student.list',compact('students')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id','name']);
        $sections = Section::get(['id','name']);
        $currentYear = date('Y');
        $years = range(2018,$currentYear);
        $batches = array_reverse($years);
        $semesters = Semester::all();
        return view('admin.student.index',compact('departments','sections','batches','semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        $classCourse = ClassCourse::where([
            'department_id' => $data['department_id'],
            'semester_id' => $data['semester_id'],
            'section_id' => $data['section_id'],
        ])->select('id')->first();
        if($classCourse)
        {
            $user = User::create($data + ['role_id' => 3]);
            $teacher = $user ? Student::create(['user_id' => $user->id,'class_course_id' => $classCourse->id] + $data) : null;
        }
        return response()->json(['success' => $teacher !== null]);
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
    public function edit(Student $student)
    {
        $departments = Department::get(['id','name']);
        $sections = Section::get(['id','name']);
        $currentYear = date('Y');
        $years = range(2018,$currentYear);
        $batches = array_reverse($years);
        $semesters = Semester::all();
        return view('admin.student.edit',compact('student','departments','sections','batches','semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();
        
        $classCourse = ClassCourse::where([
            'department_id' => $data['department_id'],
            'semester_id' => $data['semester_id'],
            'section_id' => $data['section_id'],
        ])->select('id')->first();
        
        if($classCourse)
        {
            if($student->user->update($data))
            {
                if($student->update($data + ['class_course_id' => $classCourse->id]))
                {
                    return response()->json(['success' => true]);
                }
            }
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if($student->user->delete() && $student->delete())
        {
            return redirect()->back();
        }
    }
}
