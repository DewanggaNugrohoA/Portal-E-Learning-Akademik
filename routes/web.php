<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Modul Siswa - Sevi Rina Pertiwi
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Modul Materi - Dewangga Nugroho Anwar
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

/*
|--------------------------------------------------------------------------
| Modul Nilai - Karina Hodiyah Ramadona
| Halaman Blade, proses CRUD lewat API /api/nilai
|--------------------------------------------------------------------------
*/
Route::get('/nilai', function () {
    return view('nilai.index');
})->name('nilai.index');

Route::get('/nilai/create', function () {
    return view('nilai.create');
})->name('nilai.create');

Route::get('/nilai/{id}', function ($id) {
    return view('nilai.show', compact('id'));
})->name('nilai.show');

Route::get('/nilai/{id}/edit', function ($id) {
    return view('nilai.edit', compact('id'));
})->name('nilai.edit');