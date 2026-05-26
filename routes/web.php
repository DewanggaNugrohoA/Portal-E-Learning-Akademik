<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

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