<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MateriController;

Route::get("/", function () {
    return view("welcome");
});

Route::resource("/materi", MateriController::class);

Route::get("/siswa", function () {
    return view("siswa.index");
})->name("siswa.index");

Route::get("/siswa/create", function () {
    return view("siswa.create");
})->name("siswa.create");

Route::get("/siswa/{id}", function ($id) {
    return view("siswa.show", compact("id"));
})->name("siswa.show");

Route::get("/siswa/{id}/edit", function ($id) {
    return view("siswa.edit", compact("id"));
})->name("siswa.edit");

Route::get("/nilai", [NilaiController::class, "pageIndex"])->name("nilai.index");
Route::get("/nilai/create", [NilaiController::class, "pageCreate"])->name("nilai.create");
Route::get("/nilai/{id}/edit", [NilaiController::class, "pageEdit"])->name("nilai.edit");
Route::get("/nilai/{id}", [NilaiController::class, "pageShow"])->name("nilai.show");