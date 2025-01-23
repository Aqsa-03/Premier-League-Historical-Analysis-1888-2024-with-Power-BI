<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Quiz;
use App\Models\Event;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Result;
use App\Models\Chapter;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Allotment;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->status == 'inactive')
        {
            $userName = $user->name;
            return view('inactive', compact('userName'));
        } 

        elseif ($user->role->name == 'admin') {
            $courses = Course::count();
            $teachers = Teacher::count();
            $students = Student::count();
            $allotments = Allotment::count();
            $stats = [
                'courses' => $courses,
                'teachers' => $teachers,
                'students' => $students,
                'allotments' => $allotments
            ];
            return view('admin.dashboard', compact('stats'));
        } 
        elseif ($user->role->name == 'teacher')
        {
            $teacherId = Auth::user()->teacher->id;
            $allotments = Allotment::where('teacher_id', $user->teacher->id)->with('course')->get();
            $assignmentsCount = Assignment::where('teacher_id',$teacherId)->count();
            $uniqueCourses = [];
            $uniqueStudents = [];

            foreach ($allotments as $allotment) {
                if (!is_null($allotment->course_id) && !in_array($allotment->course_id, $uniqueCourses)) {
                    $uniqueCourses[] = $allotment->course_id;
                }

                if (!is_null($allotment->class_course_id) && !is_null($allotment->classCourse)) {
                    $students = $allotment->classCourse->students;
                    foreach ($students as $student) {
                        if (!in_array($student->id, $uniqueStudents)) {
                            $uniqueStudents[] = $student->id;
                        }
                    }
                }
            }
            $courseCount = count($uniqueCourses);
            $studentCount = count($uniqueStudents);
            $messages = auth()->user()->unReadNotifications->count();

            $stats = [
                'courses' => $courseCount,
                'students' => $studentCount,
                'assignments' =>$assignmentsCount,
                'messages' =>$messages
            ];

            return view('teacher.dashboard', compact('stats'));
        } elseif ($user->role->name == 'student')
        {
            $classCourseId = Auth::user()->student->class_course_id;
            $currentDateTime = now();
            
            $assignments = Assignment::where('class_course_id', $classCourseId)
            ->where('due_date_time', '>', $currentDateTime)
            ->doesntHave('studentUploads', 'and', function ($query) {
                $query->where('student_id', Auth::user()->student->id);
            })
            ->count();

            $quizzes = Quiz::where('class_course_id', $classCourseId)
            ->where('due_date_time', '>', $currentDateTime)
            ->doesntHave('studentUploads', 'and', function ($query) {
                $query->where('student_id', Auth::user()->student->id);
            })
            ->count();

            $messages = Chat::where('student_id',auth()->user()->student->id)->count();

            $teacherIds = Allotment::where('class_course_id',$classCourseId)->pluck('teacher_id')->toArray();
            $events = Event::whereIn('teacher_id',$teacherIds)->where('start_date_time','>',$currentDateTime)->get('name');
            $stats = [
                'pending_assignments' => $assignments,
                'pending_quizzes' => $quizzes,
                'events' => $events,
                'messages' => $messages
            ];
            return view('student.dashboard', compact('stats'));
        }
    }
}
