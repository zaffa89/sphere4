<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SphereUserController;
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

Route::post('sphere/auth' , [SphereUserController::class , 'authenticate']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('sphere/check-auth' , [SphereUserController::class , 'checkAuth']);
});

Route::middleware('solutionmed')->group(function() {
    Route::post('sphere/user/create' , [SphereUserController::class , 'store']);
});
