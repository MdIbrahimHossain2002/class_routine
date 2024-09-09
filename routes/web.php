<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TeacherController;
use App\Models\Department;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('faculty-import',[FacultyController::class,'facultyImport'])->name('faculty.import');
Route::post('faculty-import-submit', [FacultyController::class, 'facultyImportSubmit'])->name('faculty.importSubmit');
Route::get('department-import',[DepartmentController::class,'departmentImport'])->name('department.import');
Route::post('department-import-submit', [DepartmentController::class, 'departmentImportSubmit'])->name('department.importSubmit');
Route::get('teacher-import',[TeacherController::class,'teacherImport'])->name('teacher.import');
Route::post('teacher-import-submit', [TeacherController::class, 'teacherImportSubmit'])->name('teacher.importSubmit');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('faculty',FacultyController::class);
Route::resource('department',DepartmentController::class);
Route::resource('program',ProgramController::class);
Route::get('/departments/{faculty_id}', [ProgramController::class, 'getDepartments'])->name('getDepartments');
Route::resource('semester',SemesterController::class);
Route::resource('teacher',TeacherController::class);
Route::resource('room',RoomController::class);
Route::resource('course',CourseController::class);
Route::get('/programs/{program_id}', [TeacherController::class, 'getPrograms'])->name('getPrograms');
Route::resource('section',SectionController::class);