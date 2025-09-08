<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RandomIzaroController;
use App\Http\Controllers\RandomQuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/quotes', [QuotesController::class, 'index'])->middleware(['auth'])->name('quotes');
Route::get('/random', [RandomQuoteController::class, 'index'])->middleware(['auth'])->name('random');
Route::get('/izaro', [RandomIzaroController::class, 'index'])->name('izaro');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('home'));
});
