<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ChatController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\EventController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\MeetingLinkController;
use App\Http\Controllers\Student\CourseContentController;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function ()
{
    Route::group(['namespace' => 'Student', 'as' => 'student.'], function ()
    {
        Route::singleton('courses/list',CourseController::class);
        Route::prefix('assignments')->group(function (){
            Route::get('list',[AssignmentController::class,'index'])->name('assignments.index');
            Route::post('view',[AssignmentController::class,'show'])->name('assignments.show');
            Route::post('store',[AssignmentController::class,'store'])->name('assignments.store');
        });
        Route::resource('quizzes',QuizController::class);
        Route::resource('meeting-links',MeetingLinkController::class);
        Route::resource('course-content',CourseContentController::class);
        Route::resource('events',EventController::class);
        Route::resource('chat',ChatController::class);
    });
});
