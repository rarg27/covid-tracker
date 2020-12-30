<?php

use App\Http\Controllers\ConductorController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('conductor')->group(function () {

    Route::post('/login', [ConductorController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/log', [ConductorController::class, 'log']);

        Route::get('/logs', [ConductorController::class, 'logList']);

        Route::get('/drivers', [ConductorController::class, 'drivers']);

    });

});
