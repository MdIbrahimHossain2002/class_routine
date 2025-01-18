<?php

use App\Models\Course;
use App\Models\Report;
use App\Models\Program;
use App\Models\Routine;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // return view('welcome');
    return view('admin');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('routine_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('faculty-import', [FacultyController::class, 'facultyImport'])->name('faculty.import');
    Route::post('faculty-import-submit', [FacultyController::class, 'facultyImportSubmit'])->name('faculty.importSubmit');
    Route::get('department-import', [DepartmentController::class, 'departmentImport'])->name('department.import');
    Route::post('department-import-submit', [DepartmentController::class, 'departmentImportSubmit'])->name('department.importSubmit');
    Route::get('teacher-import', [TeacherController::class, 'teacherImport'])->name('teacher.import');
    Route::post('teacher-import-submit', [TeacherController::class, 'teacherImportSubmit'])->name('teacher.importSubmit');
    Route::get('course-import', [CourseController::class, 'courseImport'])->name('course.import');
    Route::post('course-import-submit', [CourseController::class, 'courseImportSubmit'])->name('course.importSubmit');
    Route::get('routine-import', [RoutineController::class, 'routineImport'])->name('routine.import');
    Route::post('routine-import-submit', [RoutineController::class, 'routineImportSubmit'])->name('routine.importSubmit');

    Route::resource('faculty', FacultyController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('program', ProgramController::class);
    Route::get('/departments/{faculty_id}', [ProgramController::class, 'getDepartments'])->name('getDepartments');
    Route::resource('semester', SemesterController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('room', RoomController::class);
    Route::resource('course', CourseController::class);
    Route::get('/programs/{department_id}', [TeacherController::class, 'getPrograms'])->name('getPrograms');
    Route::resource('user', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::resource('section', SectionController::class);
    Route::resource('routine', RoutineController::class);
    Route::get('/sections/{section_id}', [RoutineController::class, 'getSections'])->name('getSections');
    Route::get('getCourse', [RoutineController::class, 'getCourse'])->name('getCourse');
    Route::get('report/batch', [ReportController::class, 'batch'])->name('report.batch');
    Route::get('report/room', [ReportController::class, 'room'])->name('report.room');
    Route::get('report/teacher', [ReportController::class, 'teacher'])->name('report.teacher');
    Route::get('report/day', [ReportController::class, 'day'])->name('report.day');
    Route::get('/get-teachers/{teacher_id}', [ReportController::class, 'getTeachers'])->name('getTeachers');


    Route::get('report/export', [ReportController::class, 'export'])->name('report.export');
    Route::get('report/export2', [ReportController::class, 'export2'])->name('report.export2');
    Route::get('report/export3', [ReportController::class, 'export3'])->name('report.export3');
    Route::get('report/export-day', [ReportController::class, 'export_day'])->name('report.export-day');
});


require __DIR__ . '/auth.php';
