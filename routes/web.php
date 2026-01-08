<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('auth');
Route::post('/checkAuth', [UserController::class, 'checkAuth'])->name('checkAuth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/studentForm', [StudentController::class, 'create'])->name('studentForm');
Route::post('/studentStore', [StudentController::class, 'store'])->name('studentStore');
Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::get('/students/{id}/del', [StudentController::class, 'delete'])->name('delStudent');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('editStudent');
Route::post('/students/update', [StudentController::class, 'update'])->name('updateStudent');
Route::get('/students/search', [StudentController::class, 'search'])->name('student.search');
Route::get('/students/{id}/view', [StudentController::class, 'view'])->name('viewStudent');