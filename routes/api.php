<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;

Route::get('/students',[StudentController::class,'index']);
Route::get('/students/search',[StudentController::class,'search']);
Route::post('/students/create',[StudentController::class,'create']);
Route::put('/students/update/{id}',[StudentController::class,'update']);
Route::delete('/students/delete/{id}',[StudentController::class,'destroy']);

Route::get('/employees',[EmployeeController::class,'index']);
Route::get('/employees/search',[EmployeeController::class,'search']);
Route::post('/employees/create',[EmployeeController::class,'create']);
Route::put('/employees/update/{id}',[EmployeeController::class,'update']);
Route::delete('/employees/delete/{id}',[EmployeeController::class,'destroy']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');