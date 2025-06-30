<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::get('/', function () {
  // return view('welcome');
  return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

include __DIR__ . '/admin.php';

Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'kh'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});


Route::get('/translations', [TranslationController::class, 'index'])->name('translations.index');
Route::post('/translations/update', [TranslationController::class, 'update'])->name('translations.update');
