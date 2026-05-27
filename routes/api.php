<?php

use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\MataPelajaranController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\NilaiController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('siswa', SiswaController::class)->names('api.siswa');
Route::apiResource('guru', GuruController::class);
Route::apiResource('materi', MateriController::class)->names('api.materi');
Route::apiResource('nilai', NilaiController::class);
Route::apiResource('mata-pelajaran', MataPelajaranController::class);

Route::get('/guru-list', [NilaiController::class, 'guru']);