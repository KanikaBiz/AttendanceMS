<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AttendanceController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
  Route::get('/', function () {
    return redirect()->route('admin.dashboard');
  });
  Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
  Route::get('permissions/changeStatus', [App\Http\Controllers\Admin\PermissionController::class, 'changeStatus'])->name('permissions.changeStatus');
  Route::resource('permissions', App\Http\Controllers\Admin\PermissionController::class)->except('create', 'update');
  Route::get('roles/changeStatus', [App\Http\Controllers\Admin\RoleController::class, 'changeStatus'])->name('roles.changeStatus');
  Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->except('create', 'update');
  Route::get('users/changeStatus', [App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('users.changeStatus');
  Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except('create', 'update');

  Route::get('teachers/changeStatus', [App\Http\Controllers\Admin\TeacherController::class, 'changeStatus'])->name('teachers.changeStatus');
  Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);

  Route::get('students/changeStatus', [App\Http\Controllers\Admin\StudentController::class, 'changeStatus'])->name('students.changeStatus');
  Route::resource('students', App\Http\Controllers\Admin\StudentController::class);

  Route::get('subjects/changeStatus', [App\Http\Controllers\Admin\SubjectController::class, 'changeStatus'])->name('subjects.changeStatus');
  Route::resource('subjects', App\Http\Controllers\Admin\SubjectController::class)->except('create', 'update');

  Route::get('semesters/changeStatus', [App\Http\Controllers\Admin\SemesterController::class, 'changeStatus'])->name('semesters.changeStatus');
  Route::resource('semesters', App\Http\Controllers\Admin\SemesterController::class)->except('create', 'update');

  Route::get('classes/changeStatus', [App\Http\Controllers\Admin\ClassController::class, 'changeStatus'])->name('classes.changeStatus');
  Route::resource('classes', App\Http\Controllers\Admin\ClassController::class)->except('create', 'update');


  Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
  Route::post('attendance', [AttendanceController::class, 'store'])->name('attendance.store');
  Route::get('attendance/teachers', [AttendanceController::class, 'getTeachers'])->name('attendance.getTeachers');
  Route::get('attendance/subjects', [AttendanceController::class, 'getSubjects'])->name('attendance.getSubjects');

});
