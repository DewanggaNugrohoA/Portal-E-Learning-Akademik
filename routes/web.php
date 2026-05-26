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

/*
|--------------------------------------------------------------------------
| Modul Materi - Dewangga Nugroho Anwar
| Halaman Blade saja, proses CRUD tetap lewat API /api/materi
|--------------------------------------------------------------------------
*/
Route::get('/materi', function () {
    return view('materi.index');
})->name('materi.index');

Route::get('/materi/create', function () {
    return view('materi.create');
})->name('materi.create');

Route::get('/materi/{id}', function ($id) {
    return view('materi.show', compact('id'));
})->name('materi.show');

Route::get('/materi/{id}/edit', function ($id) {
    return view('materi.edit', compact('id'));
})->name('materi.edit');

Route::resource('/nilai', NilaiController::class);