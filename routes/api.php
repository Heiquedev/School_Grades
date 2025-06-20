<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SchoolClassController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', function () {
    return response()->json(['sucess' => true, 'msg' => "Welcome to my third Laravel connection👌"], 200);
});

Route::resource('/students', StudentsController::class);
Route::resource('/teachers', TeachersController::class);
Route::resource('/schoolclass', SchoolClassController::class);