<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\ChatNotification;
use App\Http\Controllers\Teacher\ChatController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Teacher\EventController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\MeetingLinkController;
use App\Http\Controllers\Teacher\NotificationController;
use App\Http\Controllers\Teacher\CourseContentController;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function ()
{
    Route::group(['namespace' => 'Teacher', 'as' => 'teacher.'], function ()
    {
        Route::get('courses/list',[CourseController::class,'index'])->name('courses.index');
        Route::get('students/list',[StudentController::class,'index'])->name('students.index');
        Route::resource('assignments', AssignmentController::class);
        Route::get('student-assignments',[AssignmentController::class,'getStudentAssignments'])->name('assignments.student-assignments');
        Route::get('submitted-assignments/{id}',[AssignmentController::class,'getStudentAssignments'])->name('assignments.submission-list');

        Route::resource('quizzes', QuizController::class);
        Route::get('submitted-quizzes/{id}',[QuizController::class,'getStudentQuizzes'])->name('quizzes.submission-list');

        Route::resource('events', EventController::class);
        Route::resource('meeting-links', MeetingLinkController::class);
        Route::resource('course-content', CourseContentController::class);
        Route::resource('chat', ChatController::class);
    });
});
