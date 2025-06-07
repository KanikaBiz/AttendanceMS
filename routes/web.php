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

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Roles Management
    // Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    // Route::post('roles/{role}/permissions', [App\Http\Controllers\Admin\RoleController::class, 'syncPermissions'])->name('roles.syncPermissions');

    // Users Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Permissions Management
    // Route::resource('permissions', App\Http\Controllers\Admin\PermissionController::class);

    // Additional Admin Routes (Add more as needed)
    // Example: Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
    // Example: Route::post('/settings/update', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
});
