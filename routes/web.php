<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard.index');

Route::resource('/materi', MateriController::class);

Route::resource('/nilai', NilaiController::class);