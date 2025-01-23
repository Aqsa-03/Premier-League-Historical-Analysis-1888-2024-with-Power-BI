<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Chat;
use App\Models\Student;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ChatNotification;
use App\Http\Requests\StoreTeacherReplyRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $messages = Chat::with('student.classCourse','student.user')->where('teacher_id',$authUser->teacher->id)
        ->whereNull('reply_created_at')
        ->get();
        return view('teacher.chat.list',compact('messages'));
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
    public function show(Chat $chat)
    {
        return view('teacher.chat.view',compact('chat'));
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
    public function update(StoreTeacherReplyRequest $request, Chat $chat)
    {
        $validatedData = $request->validated();
        $teacherId = Auth::user()->teacher->id;
        if($request->file('teacher_file'))
        {
            $validatedData['teacher_file'] = Helper::uploadFile($request->teacher_file);
        }

        
                
        if($chat->update($validatedData + ['teacher_id' => $teacherId, 'reply_created_at' => now()]))
        {
            $userToNotify = Student::with('user')->where('id',$chat->student_id)->first();
            if($userToNotify)
            {
                $data = [
                    'message' => $chat->teacher->user->name.' Replied to Your Message.',
                    'chat_id' => $chat->id,
                ];
                $userToNotify->user->notify(new ChatNotification($data));
                return response()->json(['success'=>true]);
            }
            return response()->json(['success'=>true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
