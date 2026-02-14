<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiStudentsController;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('/apiStudents', ApiStudentsController::class);
Route::get('/branches', fn () => Branch::select('id', 'name')->get());
Route::get('/generate-pdf/{id}', [ApiStudentsController::class, 'generatePdf']);