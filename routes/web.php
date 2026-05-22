<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/materi', MateriController::class);