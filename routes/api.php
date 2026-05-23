<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::get("/nilai", [NilaiController::class, "index"]);
Route::post("/nilai", [NilaiController::class, "store"]);
Route::get("/nilai/{id}", [NilaiController::class, "show"]);
Route::put("/nilai/{id}", [NilaiController::class, "update"]);
Route::delete("/nilai/{id}", [NilaiController::class, "destroy"]);
Route::get("/guru", [NilaiController::class, "guru"]);