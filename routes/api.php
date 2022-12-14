<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/data',[ApiController::class, 'addData']);
Route::post('/image',[ApiController::class, 'addImage']);
Route::post('/audio',[ApiController::class, 'addAudio']);

Route::post('/otacall',[ApiController::class, 'otaUpdate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
