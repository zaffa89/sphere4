<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Paziente;
use App\Models\Prenotazione;
use Illuminate\Http\Request;

use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use App\Models\DatiCliniciMedsport;
use App\Models\Medico;
use Illuminate\Database\Eloquent\Builder;

class AccettazioneMedsportController extends Controller
{
    public function accettazione(Request $request)
    {
        $request->validate([
            'data_inizio' => 'required|date_format:Y-m-d',
            'data_fine' => 'required|date_format:Y-m-d',
        ]);
        
        /* DA SISTEMARE PER VISITE SENZA PRENOTAZIONE */
        return VisitaMedsport::whereHas('prenotazione' , function($query) { 
            $query->whereIn('sezione_visita' , ['M' , 'SM'])
                ->where('struttura_id' , 1)
                ->whereBetween('data_inizio' , [Carbon::today()->format('Y-m-d 00:00:00') , Carbon::today()->format('Y-m-d 23:59:59')])
                ->orderBy('data_inizio');
        })->with('prenotazione' , 'medico' , 'listino' , 'sport' , 'paziente' , 'societaSportiva')->get();
/*
        return Prenotazione::with('medico' , 'visita.listino' , 'visita.sport' , 'paziente')
            ->where('visita_type' , 'medsport')
            ->where('struttura_id' , 1)
            //->whereBetween('data_inizio' , [Carbon::parse($request->data_inizio) , Carbon::parse($request->data_fine)])
            ->whereBetween('data_inizio' , [Carbon::today()->format('Y-m-d 00:00:00') , Carbon::today()->format('Y-m-d 23:59:59')])
            ->orderBy('data_inizio')
            ->get();                
            */
    }

    public function calcolaPosizioneTicket(VisitaMedsport $visitaMedsport) {
               
        $visitaMedsport->load('listino');
        
        //buona salute = BB
        if( $visitaMedsport->listino->tipo_visita == 'BS' ) { return 'BB'; }

        //se paga atleta , società oppure la visita è gratuita = 40
        if(in_array($visitaMedsport->pagamento_a_carico , [ 1 , 2 , 3]) || $visitaMedsport->visita_privata) { return 40; }

        $visitaMedsport->load('prenotazione.paziente');
        //se il paziente è disabile = 10
        if( $visitaMedsport->prenotazione->paziente->disabile ) { return 10; }
        
        //se l'atleta è minorenne = 60
        if( Carbon::parse($visitaMedsport->prenotazione->paziente->data_nascita)->diff(Carbon::parse($visitaMedsport->prenotazione->data_inizio))->format('%y') < 18) { return 60; }
                
        //tutti gli altri casi ( cioè atleta maggiorenne e pagamento non specificato = 40)
        return 40;
        //min 60 ( solo quelli con convenzione )

        //magg , società o se paga l'atleta ( no convenzione ) e privato 40

        //disabile 10

        //non ago BB
    }
}
