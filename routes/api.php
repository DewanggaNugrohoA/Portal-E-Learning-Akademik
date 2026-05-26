<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::apiResource("siswa", SiswaController::class);
Route::apiResource("materi", MateriController::class);
Route::apiResource("guru", GuruController::class);
Route::apiResource('mata-pelajaran', MataPelajaranController::class);

Route::get("/nilai", [NilaiController::class, "index"]);
Route::post("/nilai", [NilaiController::class, "store"]);
Route::get("/nilai/{id}", [NilaiController::class, "show"]);
Route::put("/nilai/{id}", [NilaiController::class, "update"]);
Route::delete("/nilai/{id}", [NilaiController::class, "destroy"]);
Route::get("/guru-list", [NilaiController::class, "guru"]);