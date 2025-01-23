<?php

namespace App\Http\Controllers\Student;

use App\Models\Event;
use App\Models\Allotment;
use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classCourseId = Auth::user()->student->class_course_id;
        $teacherIds = Allotment::where('class_course_id',$classCourseId)->pluck('teacher_id')->toArray();
        $events = Event::whereIn('teacher_id',$teacherIds)->where('start_date_time','>',now())->get();
        return view('student.event.list',compact('events'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('student.event.view',compact('event'));
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
