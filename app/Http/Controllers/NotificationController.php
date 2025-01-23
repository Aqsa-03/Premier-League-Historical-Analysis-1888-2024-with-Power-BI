<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            
            $chatId = $notification->data['chat_id'];
            $userRole = auth()->user()->role->name;
            // dd($userRole);
            
            if ($userRole == 'teacher') {    
                return redirect()->route('teacher.chat.show', ['chat' => $chatId]);
            } elseif ($userRole == 'student') {
                return redirect()->route('student.chat.show', ['chat' => $chatId]);
            }
        }
    
        return abort(404);
    }
}
