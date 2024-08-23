<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CompanyController;

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


Route::apiResource('persons', PersonController::class);
Route::get('persons/search', [PersonController::class, 'search']);
Route::patch('/people/{id}/favorite', [PersonController::class, 'toggleFavorite']);
Route::get('/favorites', [PersonController::class, 'favoriteList']);
Route::apiResource('companies', CompanyController::class);


