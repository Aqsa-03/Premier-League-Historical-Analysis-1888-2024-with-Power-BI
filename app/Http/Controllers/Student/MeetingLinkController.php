<?php

namespace App\Http\Controllers\Student;

use App\Models\MeetingLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MeetingLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classCourseId = Auth::user()->student->class_course_id;
        $meetings = MeetingLink::where('class_course_id',$classCourseId)->get();
        return view('student.meeting_links.list',compact('meetings'));
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
    public function show(MeetingLink $meetingLink)
    {
        return view('student.meeting_links.view',compact('meetingLink'));
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
