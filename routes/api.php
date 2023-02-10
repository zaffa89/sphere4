<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LocalitaController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\StrutturaController;
use App\Http\Controllers\AmbulatorioController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\VisitaMedsportController;
use App\Http\Controllers\SocietaSportivaController;
use App\Http\Controllers\AccettazioneMedsportController;
use App\Http\Controllers\ListinoAmbulatorialeController;
use App\Http\Controllers\ListinoMedsportController;
use App\Http\Controllers\PrestazioneAmbulatorialeController;
use App\Http\Controllers\PrestazioneMedsportController;
use App\Models\ListinoAmbulatoriale;
use App\Models\ListinoMedsport;
use App\Models\PrestazioneAmbulatoriale;
use App\Models\PrestazioneMedsport;

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

    Route::middleware([ 'auth:sanctum' ])->group(function() {   //, 'sphere-client' 
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
        
        //SPORT
        Route::resource('sport' , SportController::class);
        Route::get('sport-tramite-tipo-visita/{tipoVisita}' , [SportController::class , 'sportTramiteTipoVisita']);

        /* MEDICINA DELLO SPORT */
        Route::prefix('medsport')->group(function() {
            //ACCETTAZIONE E VISITE
            Route::post('accettazione' , [AccettazioneMedsportController::class , 'accettazione']);
            Route::resource('visita-medsport' , VisitaMedsportController::class);
            Route::get('calcola-posizione-ticket/{visitaMedsport}' , [AccettazioneMedsportController::class , 'calcolaPosizioneTicket']);

            //LISTINI E PRESTAZIONI
            Route::resource('listino' , ListinoMedsportController::class);
            Route::resource('prestazione' , PrestazioneMedsportController::class);
            Route::get('prestazioni-listino/{listinoMedsport}' , [ListinoMedsportController::class , 'prestazioniListino']);
            Route::post('prestazioni-listino/add/{listinoMedsport}/{id}' , [ListinoMedsportController::class , 'attachPrestazione']);
            Route::delete('prestazioni-listino/remove/{listinoMedsport}/{id}' , [ListinoMedsportController::class , 'detachPrestazione']);
        });

        /* AMBULATORIALE */
        Route::prefix('ambulatoriale')->group(function() {
            //ACCETTAZIONE E VISITE


            //LISTINI E PRESTAZIONI
            Route::resource('listino' , ListinoAmbulatorialeController::class);
            Route::resource('prestazione' , PrestazioneAmbulatorialeController::class);
            Route::get('prestazioni-listino/{listinoAmbulatoriale}' , [ListinoAmbulatorialeController::class , 'prestazioniListino']);
            Route::post('prestazioni-listino/add/{listinoAmbulatoriale}/{prestazione_id}' , [ListinoAmbulatorialeController::class , 'attachPrestazione']);
            Route::delete('prestazioni-listino/remove/{listinoAmbulatoriale}/{prestazione_id}' , [ListinoAmbulatorialeController::class , 'detachPrestazione']);
        });
        
    });

    //API PANNELLO AMMINISTRAZIONE WEB
    Route::middleware([ 'auth:sanctum' , 'solutionmed' ])->group(function() {
        
        Route::resource('user', UserController::class);
    });

    Route::put('save-setting/{setting}' , [AdminController::class , 'saveSetting']);
});





