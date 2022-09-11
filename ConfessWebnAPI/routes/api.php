<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/checkConn', [ConfiguratorController::class, 'testConnection']);

Route::post('/toBot', [TelebotController::class, 'toBot']);
Route::get('/toBot', [TelebotController::class, 'toBot']);

Route::post('/store', [ConfessController::class, 'storeAPI']);
Route::get('/store', [ConfessController::class, 'storeAPI']);

Route::any('/{any}', function ($any) {
    // return 403 forbidden
    return response()->json([
        'message' => 'Forbidden'
    ], 403);
})->where('any', '.*');