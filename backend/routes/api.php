<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);

    Route ::middleware('auth:sanctum', 'role:0')->group(function(){
        Route::get('/admin', [AuthController::class, 'index']);

    });
Route ::middleware('auth:sanctum', 'role:1')->group(function(){
    Route::get('/user', [UserController::class, 'index']);

    });


    Route::get('/students',[StudentController::class,'index']);
    Route::get('/students/search',[StudentController::class,'search']);
    Route::post('/students/create',[StudentController::class,'create']);
    Route::put('/students/update/{id}',[StudentController::class,'update']);
    Route::delete('/students/delete/{id}',[StudentController::class,'destroy']);
    Route::post('/students/login',[StudentController::class,'login']);


    Route::get('/employees',[EmployeeController::class,'index']);
    Route::get('/employees/search',[EmployeeController::class,'search']);
    Route::post('/employees/create',[EmployeeController::class,'create']);
    Route::put('/employees/update/{id}',[EmployeeController::class,'update']);
    Route::delete('/employees/delete/{id}',[EmployeeController::class,'destroy']);
    Route::post('/employees/login',[EmployeeController::class,'login']);



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');