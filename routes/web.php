<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard.index');

Route::resource('/materi', MateriController::class);

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
| Modul Guru - Adel Januarti Saputri
|--------------------------------------------------------------------------
*/
Route::get('/guru', function () {
    return view('guru.index');
})->name('guru.index');

Route::get('/guru/create', function () {
    return view('guru.create');
})->name('guru.create');

Route::get('/guru/{id}', function ($id) {
    return view('guru.show', compact('id'));
})->name('guru.show');

Route::get('/guru/{id}/edit', function ($id) {
    return view('guru.edit', compact('id'));
})->name('guru.edit');

/*
|--------------------------------------------------------------------------
| Modul Mata Pelajaran - Meida Dinafani
|--------------------------------------------------------------------------
*/
Route::get('/mata-pelajaran', function () {
    return view('mata-pelajaran.index');
})->name('mata-pelajaran.index');

Route::get('/mata-pelajaran/create', function () {
    return view('mata-pelajaran.create');
})->name('mata-pelajaran.create');

Route::get('/mata-pelajaran/{id}', function ($id) {
    return view('mata-pelajaran.show', compact('id'));
})->name('mata-pelajaran.show');

Route::get('/mata-pelajaran/{id}/edit', function ($id) {
    return view('mata-pelajaran.edit', compact('id'));
})->name('mata-pelajaran.edit');

/*
|--------------------------------------------------------------------------
| Modul Nilai - Karina Hodiyah Ramadona
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