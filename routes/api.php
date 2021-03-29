<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DartController;
use App\Http\Controllers\SaveGameController;

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

Route::post('/users', [DartController::class, 'users']);
Route::post('/game', [SaveGameController::class, 'game']);
Route::get('/checkout/{score}', [DartController::class, 'checkout']);
