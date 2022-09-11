<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/setBot', [ConfiguratorController::class, 'setBot']);

Route::get('/', [ConfiguratorController::class, 'index']);

Route::get('/test', [ConfiguratorController::class, 'test']);

Route::post('/', [ConfessController::class, 'store']);

Route::any('/{any}', function ($any) {
    return redirect('/');
})->where('any', '.*');