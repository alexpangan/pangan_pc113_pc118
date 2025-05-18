<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SchoolActivityController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\Auth\RegisterController;

    Route::post('/login', [AuthController::class, 'login']);

    Route ::middleware('auth:sanctum', 'role:0')->group(function(){
        Route::get('/admin', [AuthController::class, 'auth']);

    });
    Route ::middleware('auth:sanctum', 'role:1')->group(function(){
        Route::get('/user', [UserController::class, 'auth']);
    });

    Route::get('/students',[StudentController::class,'index']);
    Route::get('/students/search/{id}',[StudentController::class,'search']);
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

    Route::get('/users', [AuthController::class, 'index']); // Get all users
    Route::post('/users', [AuthController::class, 'store']); // Create a new user
    Route::get('/users/{id}', [AuthController::class, 'show']); // Get a single user
    Route::put('/users/{id}', [AuthController::class, 'update']); // Update a user
    Route::delete('/users/{id}', [AuthController::class, 'destroy']); // Delete a user

    Route::post('/upload-file', [FileUploadController::class, 'upload']);
    
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

    //sir franz
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::post('/announcements', [AnnouncementController::class, 'store']);
    Route::post('/add-announcement', [AnnouncementController::class, 'store']);
    Route::get('/announcements/{id}', [AnnouncementController::class, 'show']);
    Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);

    Route::get('/schoolactivities', [SchoolActivityController::class, 'index']);
    Route::post('/schoolactivities', [SchoolActivityController::class, 'store']);
    Route::put('/schoolactivities/{id}', [SchoolActivityController::class, 'update']);
    Route::delete('/schoolactivities/{id}', [SchoolActivityController::class, 'destroy']);
    Route::get('/schoolactivities/{id}', [SchoolActivityController::class, 'show']);

    Route::get('/guardians', [GuardianController::class, 'index']);
    Route::post('/guardians', [GuardianController::class, 'store']);
    Route::get('/guardians/{id}', [GuardianController::class, 'show']);
    Route::put('/guardians/{id}', [GuardianController::class, 'update']);
    Route::delete('/guardians/{id}', [GuardianController::class, 'destroy']);

    // Route::get('/signup', [RegisterController::class, 'showForm'])->name('signup');
    // Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');