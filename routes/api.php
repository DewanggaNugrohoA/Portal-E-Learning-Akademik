<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;

Route::apiResource('siswa', SiswaController::class);
Route::apiResource('materi', MateriController::class);