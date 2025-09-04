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
Route::controller(UniversityController::class)->group(function () {
    Route::get('/university/create', 'create');
    Route::get('/universities/list', 'index');
    Route::get('/university/show/{id}', 'show');
    Route::get('/university/edit/{id}', 'edit');
    Route::get('/university/delete/{id}', 'delete');
    Route::get('/university/information/{id}', 'uniInfo');
    Route::get('/university/students/requests/{id}', 'studentsRequests');
    Route::post('/university/update', 'update');
    Route::post('/university/store', 'store');
});
// college routes
Route::controller(CollegeController::class)->group(function () {
    Route::get('/college/create', 'create');
    Route::get('/colleges/list', 'index');
    Route::get('/college/show/{id}', 'show');
    Route::get('/college/edit/{id}', 'edit');
    Route::get('/college/delete/{id}', 'delete');
    Route::get('/college/information/{id}', 'collegeInfo');
    Route::post('/college/update', 'update');
    Route::post('/college/store', 'store');
});
// major routes
Route::controller(MajorController::class)->group(function () {
    Route::get('/major/create', 'create');
    Route::get('/majors/list', 'index');
    Route::get('/major/show/{id}', 'show');
    Route::get('/major/edit/{id}', 'edit');
    Route::get('/major/information/{id}', 'majorInfo');
    Route::get('/major/delete/{id}', 'delete');
    Route::post('/major/update', 'update');
    Route::post('/major/store', 'store');
});
// lesson routes
Route::controller(lessonController::class)->group(function () {
    Route::get('/lesson/create', 'create');
    Route::get('/lessons/list', 'index');
    Route::get('/lesson/show/{lessonId}/row/{rowId}', 'show');
    Route::get('/lesson/edit/{lessonId}/row/{rowId}', 'edit');
    Route::get('/lesson/delete/{lessonId}/row/{rowId}', 'delete');
    Route::post('/lesson/update', 'update');
    Route::post('/lesson/store', 'store');
});
// teacher routes
Route::controller(teacherController::class)->group(function () {
    Route::get('/teacher/create', 'create');
    Route::get('/teachers/list', 'index');
    Route::get('/teacher/show/{teacherId}/row/{rowId}', 'show');
    Route::get('/teacher/edit/{teacherId}/row/{rowId}', 'edit');
    Route::get('/teacher/delete/{teacherId}/row/{rowId}', 'delete');
    Route::post('/teacher/update', 'update');
    Route::post('/teacher/store', 'store');
});
// student routes
Route::controller(studentController::class)->group(function () {
    Route::get('/student/register', 'create');
    Route::get('/students/list', 'index');
    Route::get('/student/show/{id}', 'show');
    Route::get('/student/edit/{id}', 'edit');
    Route::get('/student/delete/{id}', 'delete');
    Route::post('/student/update', 'update');
    Route::post('/student/store', 'store');
    Route::get('/student/profile', 'profile');
    Route::post('/student/information', 'info');
    Route::get('/student/requests/{id}', 'requests');
    Route::post('/request/store', 'requestStore');
    Route::post('/student/request/result', 'requestResult');
});
// student lesson routes
Route::controller(studentLessonsController::class)->group(function () {
    Route::get('/student/select/unit/{id}', 'create');
    Route::get('/student/lesson/list/{id}', 'index');
    Route::get('/student/lesson/addAndDrop/{id}', 'addAndDrop');
    Route::post('/unit/update', 'update');
    Route::post('/unit/store', 'store');
});
