<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\GuruController;

Route::apiResource('siswa', SiswaController::class);
Route::apiResource('materi', MateriController::class);
Route::apiResource('guru', GuruController::class);