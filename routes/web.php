<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MateriController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/nilai", [NilaiController::class, "pageIndex"])->name("nilai.index");
Route::get("/nilai/create", [NilaiController::class, "pageCreate"])->name("nilai.create");
Route::get("/nilai/{id}/edit", [NilaiController::class, "pageEdit"])->name("nilai.edit");
Route::get("/nilai/{id}", [NilaiController::class, "pageShow"])->name("nilai.show");

Route::resource("/materi", MateriController::class);