<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PastPaperController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GeneratePaperController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function ()
{
    return view('auth.login');
})->name('landing');

Route::middleware('auth')->group(function ()
{
    Route::get('dashboard' ,[App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});



Auth::routes(['/register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('notification/{id}', [NotificationController::class, 'markNotificationAsRead'])->name('notifications.read');



Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');



Route::fallback(function(){
    return view('fallback');
});
