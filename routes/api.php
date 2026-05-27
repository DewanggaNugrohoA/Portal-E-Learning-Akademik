<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\NilaiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('guru', GuruController::class);
Route::apiResource('materi', MateriController::class)->names('api.materi');
Route::apiResource('nilai', NilaiController::class);

Route::get('/guru-list', [NilaiController::class, 'guru']);