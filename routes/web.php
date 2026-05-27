<?php

use Illuminate\Support\Facades\Route;
use App\Models\Guru;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| Modul Siswa
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
| Modul Guru
|--------------------------------------------------------------------------
*/

Route::get('/guru', function () {
    return view('guru.index');
})->name('guru.index');

Route::get('/guru/create', function () {
    return view('guru.create');
})->name('guru.create');

Route::get('/guru/{id}', function ($id) {
    $guru = Guru::findOrFail($id);
    return view('guru.show', compact('guru'));
})->name('guru.show');

Route::get('/guru/{id}/edit', function ($id) {
    $guru = Guru::findOrFail($id);
    return view('guru.edit', compact('guru'));
})->name('guru.edit');

/*
|--------------------------------------------------------------------------
| Modul Materi
|--------------------------------------------------------------------------
*/

Route::get('/materi', function () {
    return view('materi.index');
})->name('materi.index');

Route::get('/nilai', function () {
    return view('nilai.index');
})->name('nilai.index');