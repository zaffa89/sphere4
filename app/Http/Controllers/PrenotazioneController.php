<?php

namespace App\Http\Controllers;

use App\Events\NotificaPrenotazioneCreata;
use App\Events\NotificaPrenotazioneEliminata;
use App\Models\Sport;
use App\Models\Medico;
use App\Models\Struttura;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ListinoMedsport;
use App\Models\VisitaAmbulatoriale;
use App\Events\PrenotazioneEliminata;
use App\Events\NotificaPrenotazioneModificata;
use App\Models\ListinoAmbulatoriale;

use App\Http\Requests\ValidatePrenotazioneRequest;
use App\Http\Resources\BryntumCalendarEventResource;
use App\Http\Resources\PrenotazioneCalendarioResource;

class PrenotazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //inizializza una nuova prenotazione medsport 
    public function createMedsport(Request $request)  
    {        
        $request->validate([
            'startDate' => 'required',            
            'struttura_id' => 'required',
            'resourceId' => 'required',
            'medico_id' => 'nullable',
            'sezione_visita' => 'required'            
        ]);
   
        //prendi durata di default
        $durata = 15;

        $prenotazione = new Prenotazione([
            'data_inizio' => Carbon::parse($request->startDate)->format('Y-m-d H:i:s'),
            'data_fine' => Carbon::parse($request->startDate)->addMinutes($durata)->format('Y-m-d H:i:s'),
            'struttura_id' => $request->struttura_id,
            'ambulatorio_id' => $request->resourceId,
            'medico_id' => $request->medico_id,
            'sezione_visita' => $request->sezione_visita,
            'nascosta' => $request->nascosta
        ]);
                 
        $prenotazione->visita = new VisitaMedsport(['struttura_id' => $request->struttura_id , 'medico_id' => $request->medico_id ]);
                                                                       
        return [
            'prenotazione' => $prenotazione,
            'listini_agonistici' => ListinoMedsport::where('agonistico' , true)->with('prestazioni')->get(),
            'listini_non_agonistici' => ListinoMedsport::where('agonistico' , false)->with('prestazioni')->get(),
            'elenco_sport' => Sport::orderBy('nome')->get(),
            'struttura' => Struttura::with('ambulatori' , 'orariMedici')->where('id' , $request->struttura_id)->first(),
            'medici' => Medico::all()
        ];
    }

    //inizializza una nuova prenotazione ambulatoriale 
    public function createAmbulatoriale(Request $request)  
    {        
        $request->validate([
            'startDate' => 'required',
            'struttura_id' => 'required',
            'resourceId' => 'nullable',
            'medico_id' => 'nullable',
            'sezione_visita' => 'required'            
        ]);

        //prendi durata di default
        $durata = 15;
               
        $prenotazione = new Prenotazione([
            'data_inizio' => Carbon::parse($request->startDate)->format('Y-m-d H:i:s'),
            'data_fine' => Carbon::parse($request->startDate)->addMinutes($durata)->format('Y-m-d H:i:s'),
            'struttura_id' => $request->struttura_id,
            'ambulatorio_id' => $request->resourceId,
            'medico_id' => $request->medico_id,
            'sezione_visita' => $request->sezione_visita,
            'nascosta' => $request->nascosta       
        ]);
                
        $prenotazione->visita = new VisitaAmbulatoriale(['struttura_id' => $request->struttura_id , 'medico_id' => $request->medico_id]);        
                   
        return [
            'prenotazione' => $prenotazione,          
            'listini' => ListinoAmbulatoriale::all(),
            'struttura' => Struttura::with('ambulatori' , 'orariMedici')->where('id' , $request->struttura_id)->first(),
            'medici' => Medico::all()
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeMedsport(ValidatePrenotazioneRequest $request) {
        return DB::transaction(function () use ($request) {
            $prenotazione = Prenotazione::create([
                'user_id' => auth()->user()->id,               
                'medico_id' => $request->medico_id,
                'ambulatorio_id' => $request->ambulatorio_id,
                'struttura_id' => $request->struttura_id,
                'societa_id' => $request->societa_id,
                'data_prenotazione' => now(),
                'data_inizio' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($request->data_inizio)->addMinutes($request->durata)->format('Y-m-d H:i:s'),
                'note' => $request->note,
          
                'nascosta' => $request->nascosta,
                'accettata' => false,
                'sezione_visita' => $request->sezione_visita
            ]);
            
            $mesi_scadenza = $request->visita['sport_id'] && ListinoMedsport::where('id' , $request->visita['listino_id'])->value('agonistico') ? Sport::where('id' , $request->visita['sport_id'])->value('mesi_scadenza') : config('sphere.mesi_scadenza_default');

            switch($prenotazione->sezione_visita) {
                case 'M':
                    $prenotazione->visitaMedsport()->create([
                        'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'listino_id' => $request->visita['listino_id'] , 
                        'sport_id' => $request->visita['sport_id'],
                        'paziente_id' => $request->visita['paziente_id'],
                        'medico_id' => $request->medico_id, //medico esecutore
                        'societa_id' => $request->societa_id,
                        'struttura_id' => $request->struttura_id,

                        //'visita_privata' => $request->visita['visita_privata'],
                        'data_certificato' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'mesi_validita_certificato' => $mesi_scadenza
                        
                    ]);

                    $prenotazione->load('visitaMedsport.paziente');
                break;
                case 'SM':
                    for($i = 1; $i <= $request->numero_paz; $i++) {
                        $prenotazione->visiteMedsport()->create([
                            'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'listino_id' => $request->visita['listino_id'] , 
                            'sport_id' => $request->visita['sport_id'],                            
                            'medico_id' => $request->medico_id, //medico esecutore
                            'societa_id' => $request->societa_id,
                            'struttura_id' => $request->struttura_id,

                            //'visita_privata' => $request->visita['visita_privata'],
                            'data_certificato' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'mesi_validita_certificato' => $mesi_scadenza
                        ]);
                        
                    }
                    $prenotazione->load('societaSportiva');
                break;
            }

            broadcast(new NotificaPrenotazioneCreata($prenotazione , auth()->user()->username))->toOthers();
            //return new PrenotazioneCalendarioResource($prenotazione);
            return new BryntumCalendarEventResource($prenotazione);
        });
    }

    public function storeAmbulatoriale(ValidatePrenotazioneRequest $request) 
    {
        return DB::transaction(function () use ($request) {
            $prenotazione = Prenotazione::create([
                'user_id' => auth()->user()->id,               
                'medico_id' => $request->medico_id,
                'ambulatorio_id' => $request->ambulatorio_id,
                'struttura_id' => $request->struttura_id,
                'societa_id' => $request->societa_id,
                'data_prenotazione' => now(),
                'data_inizio' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($request->data_inizio)->addMinutes($request->durata)->format('Y-m-d H:i:s'),
                'note' => $request->note,
          
                'nascosta' => $request->nascosta,
                'accettata' => false,
                'sezione_visita' => $request->sezione_visita
            ]);

            switch($prenotazione->sezione_visita) {                
                case 'A':
                    $prenotazione->visitaAmbulatoriale()->create([
                        'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'listino_id' => $request->visita['listino_id'],
                        'paziente_id' => $request->paziente_id,
                        'medico_id' => $request->medico_id, //medico esecutore
                        'societa_id' => $request->societa_id,
                        'struttura_id' => $request->struttura_id
                    ]);
                    
                break;
                case 'SA':
                    for($i = 1; $i <= $request->numero_paz; $i++) {
                        $prenotazione->visiteAmbulatoriali()->create([
                            'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'listino_id' => $request->visita['listino_id'] , 
                            'sport_id' => $request->visita['sport_id'],                            
                            'medico_id' => $request->medico_id, //medico esecutore
                            'societa_id' => $request->societa_id
                        ]);
                    }  
                break;
            }

            broadcast(new NotificaPrenotazioneCreata($prenotazione , auth()->user()->username))->toOthers();

            return new PrenotazioneCalendarioResource($prenotazione);
        });
    }
    
    public function store(ValidatePrenotazioneRequest $request)
    {                
        return DB::transaction(function () use ($request) {
            $prenotazione = Prenotazione::create([
                'user_id' => auth()->user()->id,               
                'medico_id' => $request->medico_id,
                'ambulatorio_id' => $request->ambulatorio_id,
                'struttura_id' => $request->struttura_id,
                'societa_id' => $request->societa_id,
                'data_prenotazione' => now(),
                'data_inizio' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($request->data_inizio)->addMinutes($request->durata)->format('Y-m-d H:i:s'),
                'note' => $request->note,
          
                'nascosta' => $request->nascosta,
                'accettata' => false,
                'sezione_visita' => $request->sezione_visita
            ]);
            
            $listinoMs = ListinoMedsport::find($request->visita['listino_id']);
            $mesi_scadenza = $request->visita['sport_id'] ? Sport::where('id' , $request->visita['sport_id'])->value('mesi_scadenza') : config('sphere.mesi_scadenza_default');

            switch($prenotazione->sezione_visita) {
                case 'M':
                    $prenotazione->visitaMedsport()->create([
                        'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'listino_id' => $request->visita['listino_id'] , 
                        'sport_id' => $request->visita['sport_id'],
                        'paziente_id' => $request->visita['paziente_id'],
                        'medico_id' => $request->medico_id, //medico esecutore
                        'societa_id' => $request->societa_id,
                        'struttura_id' => $request->struttura_id,

                        //'visita_privata' => $request->visita['visita_privata'],
                        'data_certificato' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'mesi_validita_certificato' => $mesi_scadenza
                        
                    ]);

                    $prenotazione->load('visitaMedsport.paziente');
                break;
                case 'SM':
                    for($i = 1; $i <= $request->numero_paz; $i++) {
                        $prenotazione->visiteMedsport()->create([
                            'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'listino_id' => $request->visita['listino_id'] , 
                            'sport_id' => $request->visita['sport_id'],                            
                            'medico_id' => $request->medico_id, //medico esecutore
                            'societa_id' => $request->societa_id,
                            'struttura_id' => $request->struttura_id,

                            //'visita_privata' => $request->visita['visita_privata'],
                            'data_certificato' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'mesi_validita_certificato' => $mesi_scadenza
                        ]);
                        $prenotazione->load('societaSportiva');
                    }                    
                break;
                case 'A':
                    $prenotazione->visitaAmbulatoriale()->create([
                        'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                        'listino_id' => $request->visita['listino_id'],
                        'paziente_id' => $request->paziente_id,
                        'medico_id' => $request->medico_id, //medico esecutore
                        'societa_id' => $request->societa_id,
                        'struttura_id' => $request->struttura_id
                    ]);
                    
                break;
                case 'SA':
                    for($i = 1; $i <= $request->numero_paz; $i++) {
                        $prenotazione->visiteAmbulatoriali()->create([
                            'data_visita' => Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s'),
                            'listino_id' => $request->visita['listino_id'] , 
                            'sport_id' => $request->visita['sport_id'],                            
                            'medico_id' => $request->medico_id, //medico esecutore
                            'societa_id' => $request->societa_id
                        ]);
                    }  
                break;
            }
                        
            broadcast(new NotificaPrenotazioneCreata($prenotazione , auth()->user()->username))->toOthers();

            return new PrenotazioneCalendarioResource($prenotazione);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function show(Prenotazione $prenotazione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */

    public function editMedsport(Prenotazione $prenotazione) 
    {
        switch($prenotazione->sezione_visita) {
            case 'M':                                
                $prenotazione->load('visitaMedsport.listino' , 'visitaMedsport.paziente' , 'societaSportiva');                
            break;
            
            case 'SM':
                $prenotazione->load('visitaMedsport' , 'societaSportiva')->loadCount('visiteMedsport');
            break;
        }

        return [
            'prenotazione' => new PrenotazioneCalendarioResource($prenotazione),
            'listini_agonistici' => ListinoMedsport::where('agonistico' , true)->with('prestazioni')->get(),
            'listini_non_agonistici' => ListinoMedsport::where('agonistico' , false)->with('prestazioni')->get(),
            'elenco_sport' => Sport::orderBy('nome')->get(),
            'struttura' => Struttura::with('ambulatori' , 'orariMedici')->where('id' , $prenotazione->struttura_id)->first(),
            'medici' => Medico::all()
        ];
    }

    public function editAmbulatoriale(Prenotazione $prenotazione)
    {

        switch($prenotazione->sezione_visita) {
            
            case 'A':
                $prenotazione->load('visitaAmbulatoriale.listino' , 'visitaAmbulatoriale.paziente');
            break;
            
            case 'SA':
                $prenotazione->load('visitaAmbulatoriale' , 'societaSportiva')->loadCount('visiteAmbulatoriali');
            break;
        }

        return [
            'prenotazione' => new PrenotazioneCalendarioResource($prenotazione),
            'listini' => ListinoAmbulatoriale::all(),
            'struttura' => Struttura::with('ambulatori' , 'orariMedici')->where('id' , $prenotazione->struttura_id)->first(),
            'medici' => Medico::all()
        ];
    }

    public function edit(Prenotazione $prenotazione)
    {
        $listini = match ($prenotazione->sezione_visita) {
            'M' , 'SM' => ListinoMedsport::with('prestazioni')->get(),
            'A' , 'SA' => ListinoAmbulatoriale::all(),
            default => null
        };

        $elenco_sport = match ($prenotazione->sezione_visita) {
            'M' , 'SM' => Sport::orderBy('nome')->get(),
            default => null
        };

        switch($prenotazione->sezione_visita) {
            case 'M':                                
                $prenotazione->load('visitaMedsport.listino' , 'visitaMedsport.paziente' , 'societaSportiva');                
            break;
            case 'A':
                $prenotazione->load('visitaAmbulatoriale.listino' , 'visitaAmbulatoriale.paziente');
            break;
            case 'SM':
                $prenotazione->load('visitaMedsport' , 'societaSportiva')->loadCount('visiteMedsport');
            break;
            case 'SA':
                $prenotazione->load('visitaAmbulatoriale' , 'societaSportiva')->loadCount('visiteAmbulatoriali');
            break;
        }

        return [
            'prenotazione' => new PrenotazioneCalendarioResource($prenotazione),
            'listini' => $listini,
            'elenco_sport' => $elenco_sport,
            'struttura' => Struttura::with('ambulatori' , 'orariMedici')->where('id' , $prenotazione->struttura_id)->first(),
            'medici' => Medico::all()
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePrenotazioneRequest $request, Prenotazione $prenotazione)  //farle separate ??
    {
       
        return DB::transaction(function () use ($request , $prenotazione) {

            $prenotazione->data_inizio = Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s');
            $prenotazione->data_fine = Carbon::parse($request->data_inizio)->addMinutes($request->durata)->format('Y-m-d H:i:s');            
            $prenotazione->ambulatorio_id = $request->ambulatorio_id;
            $prenotazione->struttura_id = $request->struttura_id;
            $prenotazione->societa_id = $request->societa_id;
            $prenotazione->medico_id = $request->medico_id;

            switch($prenotazione->sezione_visita) {
                case 'M':
                    $prenotazione->visitaMedsport->paziente_id = $request->visita['paziente_id'];
                    $prenotazione->visitaMedsport->medico_id = $request->medico_id;
                    $prenotazione->visitaMedsport->sport_id = $request->visita['sport_id'];
                    $prenotazione->visitaMedsport->listino_id = $request->visita['listino_id'];
                    $prenotazione->visitaMedsport->societa_id = $request->societa_id;
                    $prenotazione->push();

                    $prenotazione->load('visitaMedsport');
                break;
                case 'SM':
                    foreach($prenotazione->visiteMedsport as $visita) {
                        $visita->listino_id = $request->visita['listino_id'];                        
                    }                   
                    $prenotazione->push();
                    $prenotazione->load('societaSportiva')->loadCount('visiteMedsport');
                break;
                case 'A':
                    $prenotazione->visitaAmbulatoriale->paziente_id = $request->visita['paziente_id'];
                    $prenotazione->visitaAmbulatoriale->listino_id = $request->visita['listino_id'];
                    $prenotazione->visitaAmbulatoriale->societa_id = $request->societa_id;
                    $prenotazione->visitaAmbulatoriale->medico_id = $request->medico_id;
                    $prenotazione->push();

                    $prenotazione->load('visitaAmbulatoriale');
                break;
                case 'SA':

                break;
            }

            broadcast(new NotificaPrenotazioneModificata($prenotazione , auth()->user()->username))->toOthers();
            return new BryntumCalendarEventResource($prenotazione);
        });
    }

    public function dragMove(Request $request , Prenotazione $prenotazione)
    {
        $request->validate([            
            'startDate' => 'required',
            'endDate' => 'required',
            'resourceId' => 'required',
            'medico_id' => 'nullable'
        ]);

        return DB::transaction(function () use ($request , $prenotazione) {
            $prenotazione->update([
                'data_inizio' => Carbon::parse($request->startDate)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($request->endDate)->format('Y-m-d H:i:s'),
                'ambulatorio_id' => $request->resourceId,
                'medico_id' => $request->medico_id
            ]);

            return $prenotazione;
        });
    }

    public function dragResize(Request $request , Prenotazione $prenotazione)
    {
        $request->validate([            
            'startDate' => 'required',
            'endDate' => 'required',            
        ]);

        return DB::transaction(function () use ($request , $prenotazione) {
            $prenotazione->update([
                'data_inizio' => Carbon::parse($request->startDate)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($request->endDate)->format('Y-m-d H:i:s'),                
            ]);

            return $prenotazione;
        });
    }

    public function move(Request $request , Prenotazione $prenotazione) {
        $request->validate([                   
            'data_inizio' => 'required',
            'data_fine' => 'required',            
            'ambulatorio_id' => 'required',
            'medico_id' => 'nullable'
        ]);
        

        return DB::transaction(function () use ($request , $prenotazione) {         

            $prenotazione->update([
               'data_inizio' => Carbon::parse($request->data_inizio),
               'data_fine' => Carbon::parse($request->data_fine),
               'ambulatorio_id' => $request->ambulatorio_id,
               'medico_id' => $request->medico_id 
            ]);
            
            switch($prenotazione->sezione_visita) {
                case 'M':                    
                    $prenotazione->load('visitaMedsport');
                break;
                case 'SM':                    
                    $prenotazione->load('societaSportiva')->loadCount('visiteMedsport');
                break;
                case 'A':                    
                    $prenotazione->load('visitaAmbulatoriale');
                break;
                case 'SA':

                break;
            }
            broadcast(new NotificaPrenotazioneModificata($prenotazione , auth()->user()->username))->toOthers();
           
            //return $prenotazione;
        });
    }

    /*appointmen*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Prenotazione $prenotazione)
    {
        
        DB::transaction(function() use ($prenotazione , $request) {
            broadcast(new NotificaPrenotazioneEliminata($prenotazione , auth()->user()->username))->toOthers();
            $prenotazione->delete();
        });
        
        return $prenotazione->trashed();
    }
}
