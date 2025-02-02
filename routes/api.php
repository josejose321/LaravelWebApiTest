<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {

        Route::post('/auth', 'index');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
        route::get('/dashboard/users-per-day', 'getUsersPerDay');
    });

    Route::apiResource('/user', UserController::class);
});

Route::prefix('react')->as('react.')->group(function () {
    Route::apiResource('/user', UserController::class);
});
