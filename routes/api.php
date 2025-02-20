<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;

Route::get('/students',[StudentController::class,'index']);
Route::get('/employees',[EmployeeController::class,'index']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
 

//Route::get('/index',[StudentController::class,'index']);