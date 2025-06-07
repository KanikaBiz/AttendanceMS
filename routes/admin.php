<?php

use Illuminate\Support\Facades\Route;

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
  Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class)->except('create', 'update');
});
