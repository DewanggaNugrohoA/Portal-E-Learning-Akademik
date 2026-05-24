<?php

use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/materi', MateriController::class);
Route::resource('/mata-pelajaran', MataPelajaranController::class);