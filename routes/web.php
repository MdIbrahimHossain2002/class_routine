<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('faculty',FacultyController::class);
Route::resource('department',DepartmentController::class);