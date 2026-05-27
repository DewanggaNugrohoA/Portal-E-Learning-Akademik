<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\GuruController;

Route::get('/', function () {
    return redirect('/guru');
});

Route::resource('/materi', MateriController::class);

Route::resource('/guru', GuruController::class);

Route::get('/siswa', function () {
    return view('siswa.index');
})->name('siswa.index');

Route::get('/siswa/create', function () {
    return view('siswa.create');
})->name('siswa.create');

Route::get('/siswa/{id}', function ($id) {
    return view('siswa.show', compact('id'));
})->name('siswa.show');

Route::get('/siswa/{id}/edit', function ($id) {
    return view('siswa.edit', compact('id'));
})->name('siswa.edit');

Route::resource('/guru', GuruController::class);