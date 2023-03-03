<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Struttura;
use App\Models\Ambulatorio;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use App\Http\Resources\BryntumCalendarEventResource;
use App\Http\Resources\PrenotazioneCalendarioResource;
use App\Http\Resources\BryntumCalendarAmbulatorioResource;

class CalendarController extends Controller
{

    public function caricaCalendarioBryntum() 
    {
        return [
            'events' => ['rows' => BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereBetween('data_inizio' , [Carbon::now() , Carbon::now()->addDays(7)])->get())],
            'resources' => ['rows' => BryntumCalendarAmbulatorioResource::collection(Ambulatorio::all())]
        ];
    }

    public function caricaCalendarioBryntumGiornaliero() 
    {
        return [
            'events' => BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereDate('data_inizio' , Carbon::now())->get()),
            'resources' => BryntumCalendarAmbulatorioResource::collection(Ambulatorio::all())
        ];
    }

    public function autoLoad(Request $request) {
        
        return [
            'success' => true,
            'resources' => ['rows' => BryntumCalendarAmbulatorioResource::collection(Ambulatorio::all())],
            'events' => $request->startDate 
                ? ['rows' => BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereBetween('data_inizio' , [Carbon::parse($request->startDate) , Carbon::parse($request->endDate)])->limit(100)->get())]
                : ['rows' => BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereDate('data_inizio' , Carbon::now())->get())]
            
        ];
    }

    public function onDemand($mode = 'dayResourceView' , $date = null) {
        
        if(!isset($date)) $date = today();
        return [
            'success' => true,
            'resources' => BryntumCalendarAmbulatorioResource::collection(Ambulatorio::all()),
            
            'events' => BryntumCalendarEventResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.listino' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.listino')
                            ->withCount('visiteMedsport' , 'visiteAmbulatoriali')
                            ->when($mode == 'dayResourceView' , function($query) use ($date) {
                                $query->whereDate('data_inizio' , Carbon::parse($date));
                            })
                            ->when($mode == 'weekResourcesView' , function($query) use ($date) {
                                $query->whereBetween('data_inizio' , [Carbon::parse($date)->startOfWeek()->format('Y-m-d') , Carbon::parse($date)->endOfWeek()->format('Y-m-d')]);
                            })                                                        
                            ->get())
            /*
            'events' => Prenotazione::when($mode == 'day' , function($query) use ($date) {
                $query->whereDate('data_inizio' , Carbon::parse($date));
            })
            ->when($mode == 'weekResourcesView' , function($query) use ($date) {
                $query->whereBetween('data_inizio' , [Carbon::parse($date)->startOfWeek()->format('Y-m-d') , Carbon::parse($date)->endOfWeek()->format('Y-m-d')]);
            })            
            ->get()
            */
        ];
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

    public static function generaOrariDefault($medico_id , $ambulatorio_id , $data_inizio , $data_fine , $ora_inizio , $ora_fine)
    {
        $ambulatorio = Ambulatorio::find($ambulatorio_id);
        
        
        for($dataInizio = Carbon::parse($data_inizio); $dataInizio < Carbon::parse($data_fine); $dataInizio->add(1 , 'day'))
        {
            $ambulatorio->orariMedico()->create([
                'medico_id' => $medico_id,
                'data_inizio' => Carbon::parse($dataInizio->format('Y-m-d').' '.$ora_inizio)->format('Y-m-d H:i:s'),
                'data_fine' => Carbon::parse($dataInizio->format('Y-m-d').' '.$ora_fine)->format('Y-m-d H:i:s')
            ]);           
        }       
    }

    public function generaOrarioMedico(Request $request)
    {
        $request->validate([
            'medico_id' => 'required',
            'ambulatorio_id' => 'required',
            'data_inizio' => 'date_format:Y-m-d',
            'data_fine' => 'date_format:Y-m-d',
            'ora_inizio' => 'date_format:H:i:s',
            'ora_fine' => 'date_format:H:i:s'
        ]);

        $ambulatorio = Ambulatorio::find($request->ambulatorio_id);
                
        for($dataInizio = Carbon::parse($request->data_inizio); $dataInizio < Carbon::parse($request->data_fine); $dataInizio->add(1 , 'day'))
        {
            $ambulatorio->orariMedico()->create(                
                [
                    'medico_id' => $request->medico_id , 
                    'data_inizio' => Carbon::parse($dataInizio->format('Y-m-d').' '.$request->ora_inizio)->format('Y-m-d H:i:s'),
                    'data_fine' => Carbon::parse($dataInizio->format('Y-m-d').' '.$request->ora_fine)->format('Y-m-d H:i:s')
                ]
                );
        }

        return $request;
    }
}
