<?php

namespace App\Http\Controllers\Student;

use App\Models\Chat;
use App\Models\Teacher;
use App\Models\Allotment;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChatRequest;
use App\Notifications\ChatNotification;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $messages = Chat::with('teacher.user')->where('student_id',$authUser->student->id)->get();
        return view('student.chat.list',compact('messages'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $allotments = Allotment::where('class_course_id',$user->student->class_course_id)->with('teacher.user')->get();
        return view('student.chat.index',compact('allotments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        $validatedData = $request->validated();
        $studentId = Auth::user()->student->id;
        if($request->file('file'))
        {
            $validatedData['file'] = Helper::uploadFile($request->file);
        }
        
        $chat = Chat::create($validatedData + ['student_id' => $studentId, 'message_created_at' => now()]);
        if($chat)
        {
            $userToNotify = Teacher::with('user')->where('id',$validatedData['teacher_id'])->first();
            if($userToNotify)
            {
                $data = [
                    'message' => $chat->student->user->name.' Sent You a Message.',
                    'chat_id' => $chat->id,
                ];
                $userToNotify->user->notify(new ChatNotification($data));
                return response()->json(['success'=>true]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        return view('student.chat.view',compact('chat'));
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
    public function destroy(Chat $chat)
    {
        if($chat->delete())
        {
            return redirect()->back();
        }
    }
}
