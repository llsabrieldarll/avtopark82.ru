<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('users', function () {
//    return Inertia::render('users/index');
//})->middleware(['auth', 'verified'])->name('users/index');

Route::resource('users', UserController::class);

Route::get('cars', function () {
    return Inertia::render('Cars');
})->middleware(['auth', 'verified'])->name('cars');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
