<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Online\Prenotazione\IndexController;
use App\Http\Controllers\SphereUserController;
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

Route::get('/', [IndexController::class , 'index'])->name('homepage');

Route::get('/prenota', function () {
return Inertia::render('PrenotazioneOnline/Prenota');
})->name('prenotazione.nuova');

Route::get('/selezione-categoria', function () {
return Inertia::render('PrenotazioneOnline/SelezioneCategoria');
})->name('prenotazione.selezione.categoria');

Route::get('/selezione-anagrafica', function () {
return Inertia::render('PrenotazioneOnline/SelezioneAnagrafica');
})->name('prenotazione.selezione.anagrafica');

Route::middleware(['auth' , 'solutionmed'])->group(function () {
    Route::get('admin' , [AdminController::class , 'generale'])->name('admin');
    Route::get('admin/utenti' , [AdminController::class , 'utenti'])->name('admin.utenti');
    Route::get('admin/impostazioni' , [AdminController::class , 'impostazioni'])->name('admin.impostazioni');
    Route::get('admin/notifiche' , [AdminController::class , 'notifiche'])->name('admin.notifiche');
    Route::get('admin/pagamenti' , [AdminController::class , 'pagamenti'])->name('admin.pagamenti');
    Route::get('admin/integrazioni' , [AdminController::class , 'integrazioni'])->name('admin.integrazioni');    
});


/* tests */
Route::get('/certificato' , function () {
    return view('certificato' , ['nome' => 'Zaffanelli Nicholas' , 'sport' => 'Kayak']);
});

Route::prefix('sphere')->group(function() {
    Route::get('client/login' , [SphereUserController::class , 'loginWindow'])->name('sphere.client.login');
});

