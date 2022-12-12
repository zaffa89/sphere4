<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulatorioController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LocalitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\SocietaSportivaController;
use App\Http\Controllers\SphereUserController;
use App\Http\Controllers\StrutturaController;
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

Route::get('asd' , [Controller::class , 'asd']);

Route::prefix('test')->group(function() {
    
});


// API SPHERE
Route::prefix('sphere')->group(function() {

    Route::post('login' , [SphereUserController::class , 'authenticate'])->middleware('electron');

    Route::middleware([ 'auth:sanctum' , 'sphere-client' ])->group(function() {
        
        Route::get('check-auth' , [SphereUserController::class , 'checkAuth']);
        
        //STRUTTURA
        Route::resource('struttura' , StrutturaController::class);
        
        //AMBULATORI
        Route::resource('ambulatorio' , AmbulatorioController::class);
    
        //MEDICI
        Route::resource('medico' , MedicoController::class);
        Route::post('ricerca-medico' , [MedicoController::class , 'ricercaMedico']);
    
        //PAZIENTI
        Route::resource('paziente' , PazienteController::class);     
        Route::post('ricerca-paziente' , [PazienteController::class , 'ricercaPaziente']);
        Route::post('calcola-codice-fiscale' , [PazienteController::class , 'calcolaCodiceFiscale']);
        Route::get('cerca-tramite-codice-fiscale/{codiceFiscale}' , [PazienteController::class , 'cercaTramiteCodiceFiscale']);

        //SOCIETA SPORTIVE
        Route::resource('societa-sportiva' , SocietaSportivaController::class);
        Route::post('ricerca-societa' , [SocietaSportivaController::class , 'search']);
        
        //PRENOTAZIONI
        Route::resource('prenotazione' , PrenotazioneController::class)->except('create'); //metodo CREATE separato in quanto creare una prenotazione richiede l'invio di dati dal calendario
        Route::post('prenotazione/create' , [PrenotazioneController::class , 'create']);
        
        //LOCALITA
        Route::resource('localita' , LocalitaController::class);
        Route::post('ricerca-localita' , [LocalitaController::class , 'ricerca']);

        //CALENDARIO
        Route::get('calendario/carica' , [CalendarController::class , 'caricaCalendario']);
        Route::put('calendario/sposta-prenotazione/{prenotazione}' , [PrenotazioneController::class , 'move']);
        Route::post('calendario/genera-orario-medico' , [CalendarController::class , 'generaOrarioMedico']);
    });

    //API PANNELLO AMMINISTRAZIONE WEB
    Route::middleware([ 'auth:sanctum' , 'solutionmed' ])->group(function() {
        Route::post('user/create' , [SphereUserController::class , 'store']);
    });

});





