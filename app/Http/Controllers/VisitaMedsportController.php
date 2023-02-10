<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Medico;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use App\Models\VisitaMedsport;
use Illuminate\Support\Facades\DB;
use App\Events\VisitaMedsportModificata;
use App\Events\VisitaMedsportVisualizzata;

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
    public function store(Request $request)
    {
        //90000630195 cod fiscale interfulmina
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
                $replicaDatiClinici = $visitaPrecedente->datiClinici->replicate();
                $replicaPreAnamnesi = $visitaPrecedente->preAnamnesi->replicate();
                    
                $visitaMedsport->datiClinici()->save($replicaDatiClinici);
                $visitaMedsport->preAnamnesi()->save($replicaPreAnamnesi);
            }
            else {
                //crea dati clinici di default
                $visitaMedsport->datiClinici()->create();
                $visitaMedsport->preAnamnesi()->create();
            }
        }

        return [
            'visita' => $visitaMedsport->load('prenotazione' , 'datiClinici' , 'preAnamnesi' , 'medico' , 'listino' , 'sport' , 'paziente.localitaNascita' , 'paziente.localitaResidenza'),
            'elenco_sport' => Sport::where('tipo_visita' , $visitaMedsport->sport->tipo_visita)->get(),
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
    public function update(Request $request, VisitaMedsport $visitaMedsport)
    {
        //aggiungere validazione

        DB::transaction(function () use ($request , $visitaMedsport) {
            
         
            
            //VisitaMedsportModificata::dispatchIf($visitaMedsport->isDirty() , $visitaMedsport , auth()->user()->id);
            $visitaMedsport->save();
        });
        

        return $visitaMedsport;
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
