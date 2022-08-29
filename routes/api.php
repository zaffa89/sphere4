<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulatorioController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PazienteController;
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
//API PANNELLO AMMINISTRAZIONE WEB
Route::middleware([ 'auth:sanctum' , 'solutionmed' ])->group(function() {
    Route::post('sphere/user/create' , [SphereUserController::class , 'store']);
});

//API PRENOTAZIONE ONLINE
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// API PER CLIENT SPHERE 
Route::post('sphere/auth' , [SphereUserController::class , 'authenticate']); //LOGIN CLIENT SPHERE
Route::middleware([ 'auth:sanctum' , 'sphere-client' ])->group(function() {
    //AUTENTICAZIONE
    Route::get('sphere/check-auth' , [SphereUserController::class , 'checkAuth']);

    //AMBULATORI
    Route::resource('ambulatorio' , AmbulatorioController::class);

    //MEDICI
    Route::resource('medico' , MedicoController::class);

    //PAZIENTI
    Route::resource('paziente' , PazienteController::class);
    
});


