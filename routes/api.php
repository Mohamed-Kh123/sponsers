<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\DeviceTokenController;
use App\Http\Controllers\Api\SponserController;
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


Route::apiResource('sponsers', SponserController::class)->middleware('auth:sanctum');

Route::post('auth/tokens', [AuthTokensController::class, 'store']);
Route::delete('auth/tokens', [AuthTokensController::class, 'destroy'])->middleware('auth:sanctum');


Route::post('device/tokens', [DeviceTokenController::class, 'store'])->middleware('auth:sanctum');
