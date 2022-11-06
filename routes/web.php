<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FileController;

Route::get('/', [DataController::class, 'index']);
Route::get('/modal/files/{type}', [FileController::class, 'getFile']);
Route::get('/modal/{type}', [DataController::class, 'getRecords']);
Route::post('/update', [DataController::class, 'getUpdate']);
