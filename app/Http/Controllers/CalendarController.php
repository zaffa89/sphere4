<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Struttura;
use App\Models\Ambulatorio;
use App\Models\OrarioMedico;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use Illuminate\Database\Query\Builder;
use App\Http\Resources\BryntumCalendarEventResource;
use App\Http\Resources\PrenotazioneCalendarioResource;
use App\Http\Resources\BryntumCalendarTimeRangeResource;

use App\Http\Resources\BryntumCalendarEventCountResource;
use App\Http\Resources\BryntumCalendarAmbulatorioResource;
use App\Http\Resources\BryntumCalendarOrarioMedicoEventResource;

class CalendarController extends Controller
{
    public function onDemand(Request $request)
    {

        $prenotazioni = BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')
            //->withCount('visiteMedsport' , 'visiteAmbulatoriali')
            ->whereBetween('data_inizio' , [Carbon::parse($request->startDate)->format('Y-m-d') , Carbon::parse($request->endDate)->format('Y-m-d')])->get());

        $orariMedici = OrarioMedico::whereBetween('data_inizio' , [Carbon::parse($request->startDate)->format('Y-m-d') , Carbon::parse($request->endDate)->format('Y-m-d')])->get();
        
        

        //eventi AllDay generati usando gli orari medici
       
        return [
            'success' => true,
            //ambulatori / o medici ?
            'resources' => [
                'rows' => BryntumCalendarAmbulatorioResource::collection(Ambulatorio::all()),
            ],
            //timeranges per calendario
            'resourceTimeRanges' => [
                'rows' => BryntumCalendarTimeRangeResource::collection($orariMedici)
            ],
            //prenotazioni ed eventi allDay per simulare l'orario medico
            'events' => [
                'rows' => $prenotazioni->merge(BryntumCalendarOrarioMedicoEventResource::collection($orariMedici->load('medico')))
            ],
        ];
    }

    public function countPrenotazioniPerDatepicker() {
        return Prenotazione::selectRaw('count(id) , CAST(data_inizio as DATE)')->groupByRaw('CAST(data_inizio as DATE)')->get();
        
    }

    public function caricaCalendario()
    {
        
        return [                        
            'prenotazioni' => PrenotazioneCalendarioResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereBetween('data_inizio' , [Carbon::now()->subMonth() , Carbon::now()->addMonths(1)])->get()),
            'strutture' => Struttura::with('ambulatori' , 'orariMedici')->get()             
        ];
    }

    public function caricaCalendarioGiornalmente($data)
    {
        return [                        
            'prenotazioni' => PrenotazioneCalendarioResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereDate('data_inizio' , Carbon::parse($data))->get()),            
            'strutture' => Struttura::with('ambulatori' , 'orariMedici')->get()             
        ];
    }    
}
