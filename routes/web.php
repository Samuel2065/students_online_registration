<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register1', [StudentController::class, 'register1'])->name('register1');
Route::post('/register1', [StudentController::class, 'register1Post']);

Route::get('/register2', [StudentController::class, 'register2'])->name('register2');
Route::post('/register2', [StudentController::class, 'register2Post']);

Route::get('/register3', [StudentController::class, 'register3'])->name('register3');
Route::post('/register3', [StudentController::class, 'register3Post']);

Route::get('/register4', [StudentController::class, 'register4'])->name('register4');
Route::post('/register4', [StudentController::class, 'register4Post']);

Route::get('/register5', [StudentController::class, 'register5'])->name('register5');
Route::post('/register5', [StudentController::class, 'register5Post']);

Route::get('/register6', [StudentController::class, 'register6'])->name('register6');
Route::post('/register6', [StudentController::class, 'register6Post']);

Route::get('/registration_success_page', function () {
    return view('registration_success_page');
});

Route::get('/', function () {
    return view('home');
});
