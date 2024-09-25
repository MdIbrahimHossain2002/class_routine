<?php

use App\Models\Course;
use App\Models\Program;
use App\Models\Routine;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('faculty-import',[FacultyController::class,'facultyImport'])->name('faculty.import');
Route::post('faculty-import-submit', [FacultyController::class, 'facultyImportSubmit'])->name('faculty.importSubmit');
Route::get('department-import',[DepartmentController::class,'departmentImport'])->name('department.import');
Route::post('department-import-submit', [DepartmentController::class, 'departmentImportSubmit'])->name('department.importSubmit');
Route::get('teacher-import',[TeacherController::class,'teacherImport'])->name('teacher.import');
Route::post('teacher-import-submit', [TeacherController::class, 'teacherImportSubmit'])->name('teacher.importSubmit');
Route::get('course-import',[CourseController::class,'courseImport'])->name('course.import');
Route::post('course-import-submit', [CourseController::class, 'courseImportSubmit'])->name('course.importSubmit');
Route::get('routine-import',[RoutineController::class,'routineImport'])->name('routine.import');
Route::post('routine-import-submit', [RoutineController::class, 'routineImportSubmit'])->name('routine.importSubmit');

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
Route::get('/programs/{department_id}', [TeacherController::class, 'getPrograms'])->name('getPrograms');
Route::resource('section',SectionController::class);
Route::resource('routine',RoutineController::class);
Route::get('/sections/{section_id}', [RoutineController::class, 'getSections'])->name('getSections');


require __DIR__.'/auth.php';
