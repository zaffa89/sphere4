<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulatorioController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\PrenotazioneController;
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

//API PRENOTAZIONE ONLINE
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('test')->group(function() {
    Route::get('pazienti-e-prenotazioni' , [PazienteController::class , 'tutto']);
});


// API SPHERE
Route::prefix('sphere')->group(function() {

    Route::get('prova' , [PazienteController::class , 'provaMorph']);

    Route::post('login' , [SphereUserController::class , 'authenticate']);


    Route::middleware([ 'auth:sanctum' , 'sphere-client' ])->group(function() {
        
        Route::get('check-auth' , [SphereUserController::class , 'checkAuth']);
    
        //AMBULATORI
        Route::resource('ambulatorio' , AmbulatorioController::class);
    
        //MEDICI
        Route::resource('medico' , MedicoController::class);
    
        //PAZIENTI
        Route::resource('paziente' , PazienteController::class);

        //PRENOTAZIONI
        Route::resource('prenotazione' , PrenotazioneController::class);
        
    });

    //API PANNELLO AMMINISTRAZIONE WEB
    Route::middleware([ 'auth:sanctum' , 'solutionmed' ])->group(function() {
        Route::post('user/create' , [SphereUserController::class , 'store']);
    });

});





