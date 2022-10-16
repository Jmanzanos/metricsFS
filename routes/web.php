<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DataController::class, 'index']);
Route::get('/modal/{type}', [DataController::class, 'getRecords']);
Route::post('/update', [DataController::class, 'getUpdate']);
