<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user','department')->get();
        return view('admin.teacher.list',compact('teachers')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id','name']);
        return view('admin.teacher.index',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data + ['role_id' => 2]);
        $teacher = $user ? Teacher::create(['user_id' => $user->id] + $data) : null;
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
    public function edit(Teacher $teacher)
    {
        $departments = Department::get(['id','name']);
        return view('admin.teacher.edit',compact('teacher','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request,Teacher $teacher)
    {
        $data = $request->validated();
        if($teacher->user->update($data))
        {
            if($teacher->update($data))
            {
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if($teacher->user->delete() && $teacher->delete())
        {
            return redirect()->back();
        }
    }
}
