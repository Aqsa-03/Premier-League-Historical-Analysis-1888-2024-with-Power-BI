<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Allotment;
use App\Models\MeetingLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMeetingLinkRequest;
use App\Http\Requests\UpdateMeetingLinkRequest;

class MeetingLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = Auth::user()->teacher->id;
        $links = MeetingLink::where('teacher_id',$teacherId)->get();
        return view('teacher.meeting-link.list',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.meeting-link.index',compact('allotments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingLinkRequest $request)
    {
        // dd($request->all());
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if(MeetingLink::create($data + ['teacher_id' => $teacherId]))
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
    public function edit(MeetingLink $meeting_link)
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.meeting-link.edit',compact('meeting_link','allotments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingLinkRequest $request, MeetingLink $meeting_link)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($meeting_link->update($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingLink $meeting_link)
    {
        if($meeting_link->delete())
        {
            return redirect()->back();
        }
    }
}
