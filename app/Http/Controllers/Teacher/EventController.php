<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Quiz;
use App\Models\Event;
use App\Models\Allotment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = Auth::user()->teacher->id;
        $events = Event::where('teacher_id',$teacherId)->get();
        return view('teacher.event.list',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.event.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if(Event::create($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $user = Auth::user();
        return view('teacher.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $teacherId = Auth::user()->teacher->id;
        $data = $request->validated();
        if($event->update($data + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if($event->delete())
        {
            return redirect()->back();
        }
    }
}
