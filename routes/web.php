<?php

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\lessonController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\studentLessonsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('menu');
});
// uni routes
Route::get('/university/create', [UniversityController::class, 'create']);
Route::get('/universities/list', [UniversityController::class, 'index']);
Route::get('/university/show/{id}', [UniversityController::class, 'show']);
Route::get('/university/edit/{id}', [UniversityController::class, 'edit']);
Route::get('/university/delete/{id}', [UniversityController::class, 'delete']);
Route::get('/university/information/{id}', [UniversityController::class, 'uniInfo']);
Route::get('/university/students/requests/{id}', [UniversityController::class, 'studentsRequests']);
Route::post('/university/update', [UniversityController::class, 'update']);
Route::post('/university/store', [UniversityController::class, 'store']);
// college routes
Route::get('/college/create', [collegeController::class, 'create']);
Route::get('/colleges/list', [collegeController::class, 'index']);
Route::get('/college/show/{id}', [collegeController::class, 'show']);
Route::get('/college/edit/{id}', [collegeController::class, 'edit']);
Route::get('/college/delete/{id}', [collegeController::class, 'delete']);
Route::get('/college/information/{id}', [collegeController::class, 'collegeInfo']);
Route::post('/college/update', [collegeController::class, 'update']);
Route::post('/college/store', [collegeController::class, 'store']);
// major routes
Route::get('/major/create', [majorController::class, 'create']);
Route::get('/majors/list', [majorController::class, 'index']);
Route::get('/major/show/{id}', [majorController::class, 'show']);
Route::get('/major/edit/{id}', [majorController::class, 'edit']);
Route::get('/major/information/{id}', [majorController::class, 'majorInfo']);
Route::get('/major/delete/{id}', [majorController::class, 'delete']);
Route::post('/major/update', [majorController::class, 'update']);
Route::post('/major/store', [majorController::class, 'store']);
// lesson routes
Route::get('/lesson/create', [lessonController::class, 'create']);
Route::get('/lessons/list', [lessonController::class, 'index']);
Route::get('/lesson/show/{lessonId}/row/{rowId}', [lessonController::class, 'show']);
Route::get('/lesson/edit/{lessonId}/row/{rowId}', [lessonController::class, 'edit']);
Route::get('/lesson/delete/{lessonId}/row/{rowId}', [lessonController::class, 'delete']);
Route::post('/lesson/update', [lessonController::class, 'update']);
Route::post('/lesson/store', [lessonController::class, 'store']);
// teacher routes
Route::get('/teacher/create', [teacherController::class, 'create']);
Route::get('/teachers/list', [teacherController::class, 'index']);
Route::get('/teacher/show/{teacherId}/row/{rowId}', [teacherController::class, 'show']);
Route::get('/teacher/edit/{teacherId}/row/{rowId}', [teacherController::class, 'edit']);
Route::get('/teacher/delete/{teacherId}/row/{rowId}', [teacherController::class, 'delete']);
Route::post('/teacher/update', [teacherController::class, 'update']);
Route::post('/teacher/store', [teacherController::class, 'store']);
// student routes
Route::get('/student/register', [studentController::class, 'create']);
Route::get('/students/list', [studentController::class, 'index']);
Route::get('/student/show/{id}', [studentController::class, 'show']);
Route::get('/student/edit/{id}', [studentController::class, 'edit']);
Route::get('/student/delete/{id}', [studentController::class, 'delete']);
Route::post('/student/update', [studentController::class, 'update']);
Route::post('/student/store', [studentController::class, 'store']);
Route::get('/student/profile', [studentController::class, 'profile']);
Route::post('/student/information', [studentController::class, 'info']);
Route::get('/student/requests/{id}', [studentController::class, 'requests']);
Route::post('/request/store', [studentController::class, 'requestStore']);
Route::post('/student/request/result', [studentController::class, 'requestResult']);
// student lesson routes
Route::get('/student/select/unit/{id}', [studentLessonsController::class, 'create']);
Route::get('/student/lesson/list/{id}', [studentLessonsController::class, 'index']);
Route::get('/student/lesson/addAndDrop/{id}', [studentLessonsController::class, 'addAndDrop']);
Route::post('/unit/update', [studentLessonsController::class, 'update']);
Route::post('/unit/store', [studentLessonsController::class, 'store']);
