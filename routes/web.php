<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    //redirect to the login page
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin', function () {
    return view('layouts.master_lte');
})->name('admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::resource('users', UserController::class);
    // Route::resource('roles', RoleController::class);
    // Route::resource('permissions', PermissionController::class);
    // Route::resource('settings', SettingController::class);
});
