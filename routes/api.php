<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\NewsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('getNewsList', [NewsController::class, 'getNewsList']);
    Route::get('getNews/{id}', [NewsController::class, 'getNews']);
});

Route::middleware(['auth:api', 'has:admin'])->prefix('admin')->group(function () {
    Route::get('getNewsList', [NewsController::class, 'getNewsListForAdmin']);
    Route::get('getNews/{id}', [NewsController::class, 'getNewsForAdmin']);
    Route::post('createNews', [NewsController::class, 'createNews']);
    Route::put('updateNewsStatus/{id}', [NewsController::class, 'updateNewsStatus']);
});

Route::post('login', [LoginController::class, 'login'])->name('login');

