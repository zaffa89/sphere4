<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FormSphereController;
use App\Http\Controllers\Online\Prenotazione\IndexController;
use App\Http\Controllers\StampeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [IndexController::class , 'index'])->name('homepage');
/*
Route::get('/prenota', function () {
return Inertia::render('PrenotazioneOnline/Prenota');
})->name('prenotazione.nuova');

Route::get('/selezione-categoria', function () {
return Inertia::render('PrenotazioneOnline/SelezioneCategoria');
})->name('prenotazione.selezione.categoria');

Route::get('/selezione-anagrafica', function () {
return Inertia::render('PrenotazioneOnline/SelezioneAnagrafica');
})->name('prenotazione.selezione.anagrafica');
*/

Route::get('/' , [FormSphereController::class , 'mainForm'])->middleware('auth')->name('sphere.main');

Route::get('/anagrafiche/pazienti' , [FormSphereController::class , 'formPazienti'])->middleware('auth')->name('sphere.anagrafiche.pazienti');
Route::get('/anagrafiche/ambulatori' , [FormSphereController::class , 'formAmbulatori'])->middleware('auth')->name('sphere.anagrafiche.ambulatori');
Route::get('/calendario' , [CalendarController::class , 'caricaCalendario'])->middleware('auth')->name('sphere.calendario');

Route::prefix('sphere')->group(function() {
    Route::get('client/login' , [UserController::class , 'clientLoginForm'])  //FORM DI LOGIN PER CLIENT ELECTRON
        //->middleware('electron')
        ->name('sphere.login.form');

    Route::post('login' , [UserController::class , 'doLogin'])    //LOGIN HANDLER PER CLIENT ELECTRON
        //->middleware('electron')
        ->name('sphere.login');

    //STAMPE
    Route::get('stampe/maschera-stampa' , function() {
        return Inertia::render('Sphere/Stampe/MascheraStampa');
    });
    
    Route::get('stampe/certificati/agonistico/{visitaMedsport}' , [StampeController::class , 'stampaCertificatoAgonistico']);

    Route::middleware(['auth' , 'solutionmed'])->group(function () {
        Route::get('/' , [AdminController::class , 'generale'])->name('admin');
        Route::get('utenti' , [AdminController::class , 'utenti'])->name('admin.utenti');
        Route::get('impostazioni' , [AdminController::class , 'impostazioni'])->name('admin.impostazioni');
        Route::get('notifiche' , [AdminController::class , 'notifiche'])->name('admin.notifiche');
        Route::get('pagamenti' , [AdminController::class , 'pagamenti'])->name('admin.pagamenti');
        Route::get('integrazioni' , [AdminController::class , 'integrazioni'])->name('admin.integrazioni');    
    });
});

/* tests */
Route::get('/certificato' , function () {
    return view('certificato' , ['nome' => 'Zaffanelli Nicholas' , 'sport' => 'Kayak']);
});

Route::prefix('sphere')->group(function() {
    //Route::get('external/login' , [UserController::class , 'externalLoginForm'])->name('sphere.external.login.form');

    Route::middleware(['sphere-user'])->group(function() { // 'auth:sanctum' , 
        
    });
});