<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MateriController;

Route::apiResource('siswa', SiswaController::class)->names('api.siswa');
Route::apiResource('guru', GuruController::class)->names('api.guru');
Route::apiResource('materi', MateriController::class)->names('api.materi');