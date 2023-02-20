<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Medico;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidatePrenotazioneRequest;
use App\Http\Requests\ValidateVisitaMedsportRequest;

class VisitaMedsportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePrenotazioneRequest $request)
    {        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaMedsport $visitaMedsport)
    {
        //$visitaMedsport->load('prenotazione' , 'datiClinici' , 'preAnamnesi');
        
        if( !$visitaMedsport->datiClinici ) { 
            //prendi dati clinici da visita precedente
            $visitaPrecedente = VisitaMedsport::with('datiClinici' , 'preAnamnesi')->where('accettata' , true)->where('paziente_id' , $visitaMedsport->paziente_id)->orderBy('accettata_at' , 'desc')->first();
            
            if( $visitaPrecedente ) {                    
                $visitaMedsport->datiClinici()->save($visitaPrecedente->datiClinici->replicate());
                $visitaMedsport->preAnamnesi()->save($visitaPrecedente->preAnamnesi->replicate());
            }
            else {
                //crea dati clinici di default
                $visitaMedsport->datiClinici()->create();
                $visitaMedsport->preAnamnesi()->create();
            }
        }

        return [
            'visita' => $visitaMedsport->load('prenotazione' , 'datiClinici' , 'preAnamnesi' , 'medico' , 'listino' , 'sport' , 'paziente.localitaNascita' , 'paziente.localitaResidenza'),
            'elenco_sport' => $visitaMedsport->listino->agonistico ? Sport::where('tipo_visita' , $visitaMedsport->listino->tipo_visita)->get() : Sport::all(),
            'elenco_medici' => Medico::where('attivo' , true)->orWhere('id' , $visitaMedsport->medico_id)->orderBy('ragione_sociale')->get()
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaMedsport $visitaMedsport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateVisitaMedsportRequest $request, VisitaMedsport $visitaMedsport)
    {
       
        return DB::transaction(function () use ($request , $visitaMedsport) {
            
            // update visita
            $visitaMedsport->update([
                'data_visita' => $request->data_visita,
                'medico_id' => $request->medico_id,
                'paziente_id' => $request->paziente_id,
                'societa_id' => $request->societa_id,
                'listino_id' => $request->listino_id,
                'sport_id' => $request->sport_id,
            ]);

            //update note prenotazione
            Prenotazione::find($visitaMedsport->prenotazione_id)->update(['note' => $request->prenotazione['note']]);


            
            return $visitaMedsport->load('prenotazione' , 'datiClinici' , 'preAnamnesi' , 'medico' , 'listino' , 'sport' , 'paziente.localitaNascita' , 'paziente.localitaResidenza');
        });
    }

    public function eseguiAccettazione(VisitaMedsport $visitaMedsport) {
        
        return DB::transaction(function () use ($visitaMedsport) {

            //genera numero certificato
            
            $visitaMedsport->update([
                'accettata' => true,
                'accettata_at' => now()
            ]);

            return $visitaMedsport->load('prenotazione' , 'datiClinici' , 'preAnamnesi' , 'medico' , 'listino' , 'sport' , 'paziente.localitaNascita' , 'paziente.localitaResidenza');

        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaMedsport $visitaMedsport)
    {
        //
    }
}
