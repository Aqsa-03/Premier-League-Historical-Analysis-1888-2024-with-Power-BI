<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Allotment;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllotmentRequest;
use App\Http\Requests\UpdateAllotmentRequest;

class AllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allotments = Allotment::all();
        return view('admin.allotment.list',compact('allotments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $courses = Course::all();
        $classes = ClassCourse::all();
        return view('admin.allotment.index',compact('teachers','courses','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllotmentRequest $request)
    {
        $data = $request->validated();
        if(Allotment::create($data))
        {
            return response()->json(['success' => true]);
        }
        // dd($request->all());
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
    public function edit(Allotment $allotment)
    {
        $teachers = Teacher::all();
        $courses = Course::all();
        $classes = ClassCourse::all();
        return view('admin.allotment.edit',compact('teachers','courses','classes','allotment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllotmentRequest $request, Allotment $allotment)
    {
        $data = $request->validated();
        
        if($allotment->update($data))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allotment $allotment)
    {
        if($allotment->delete())
        {
            return redirect()->back();
        }
    }
}
