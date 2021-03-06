<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VimeoController;

use App\Http\Controllers\ApiAuthController;

use App\Http\Controllers\ApplicationSubmissionController;

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


Route::get('/vimeo', [VimeoController::class, 'getMovies']);

Route::post('/register', [ApiAuthController::class, 'register']);

Route::post('/login', [ApiAuthController::class, 'login']);


Route::post('/verify_otp', [ApiAuthController::class, 'verify_otp'])->middleware('auth:sanctum');


Route::post('/update_application', [ApplicationSubmissionController::class, 'update_application'])->middleware('auth:sanctum');

Route::post('/playersData', [ApplicationSubmissionController::class, 'playersData'])->middleware('auth:sanctum');

