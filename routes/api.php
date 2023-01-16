<?php

use App\Http\Controllers\AccettazioneMedsportController;
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
use App\Http\Controllers\SportController;
use App\Http\Controllers\StrutturaController;
use App\Http\Controllers\VisitaMedsportController;
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
        //Route::post('ricerca-paziente' , [PazienteController::class , 'ricercaPaziente']);
        Route::get('ricerca-paziente/{queryRicerca}' , [PazienteController::class , 'ricercaPaziente']);
        Route::post('calcola-codice-fiscale' , [PazienteController::class , 'calcolaCodiceFiscale']);
        Route::get('cerca-tramite-codice-fiscale/{codiceFiscale}' , [PazienteController::class , 'cercaTramiteCodiceFiscale']);

        //SOCIETA SPORTIVE
        Route::resource('societa-sportiva' , SocietaSportivaController::class);
        Route::get('ricerca-societa/{queryRicerca}' , [SocietaSportivaController::class , 'ricercaSocieta']);

        //PRENOTAZIONI
        Route::resource('prenotazione' , PrenotazioneController::class)->except('create'); //metodo CREATE separato in quanto creare una prenotazione richiede l'invio di dati dal calendario
        Route::post('prenotazione/create' , [PrenotazioneController::class , 'create']);
        
        //LOCALITA
        Route::resource('localita' , LocalitaController::class);
        Route::get('ricerca-localita/codice-catastale/{codice}' , [LocalitaController::class , 'cercaTramiteCodiceCatastale']);
        //Route::post('ricerca-localita' , [LocalitaController::class , 'ricerca']);
        Route::get('ricerca-localita/nome/{queryRicerca}' , [LocalitaController::class , 'ricerca']);

        //CALENDARIO
        Route::get('calendario/carica' , [CalendarController::class , 'caricaCalendario']);
        Route::put('calendario/sposta-prenotazione/{prenotazione}' , [PrenotazioneController::class , 'move']);
        Route::post('calendario/genera-orario-medico' , [CalendarController::class , 'generaOrarioMedico']);

        //ACCETTAZIONE MEDSPORT
        Route::post('carica-accettazione-medsport' , [AccettazioneMedsportController::class , 'accettazioni']);
        Route::get('apri-visita-medsport/{visitaMedsport}' , [AccettazioneMedsportController::class , 'apriVisita']);
        Route::get('calcola-posizione-ticket/{visitaMedsport}' , [AccettazioneMedsportController::class , 'calcolaPosizioneTicket']);

        //VISITE MEDSPORT
        Route::resource('visita-medsport' , VisitaMedsportController::class);

        //ACCETTAZIONE AMBULATORIALE 

        //VISITE AMBULATORIALI
        //SPORT
        Route::resource('sport' , SportController::class);
        Route::get('sport-tramite-tipo-visita/{tipoVisita}' , [SportController::class , 'sportTramiteTipoVisita']);
    });

    //API PANNELLO AMMINISTRAZIONE WEB
    Route::middleware([ 'auth:sanctum' , 'solutionmed' ])->group(function() {
        Route::post('user/create' , [SphereUserController::class , 'store']);
    });

    Route::put('save-setting/{setting}' , [AdminController::class , 'saveSetting']);
});





