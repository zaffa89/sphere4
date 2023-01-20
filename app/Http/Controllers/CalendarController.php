<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Struttura;
use App\Models\Ambulatorio;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\PrenotazioneCalendarioResource;

class CalendarController extends Controller
{
    public function caricaCalendario()
    {        
        return [                        
            'prenotazioni' => PrenotazioneCalendarioResource::collection(Prenotazione::with('societaSportiva' , 'visitaMedsport.paziente' , 'visitaMedsport.prestazione' , 'visitaAmbulatoriale.paziente' , 'visitaAmbulatoriale.prestazione')->withCount('visiteMedsport' , 'visiteAmbulatoriali')->whereBetween('data_inizio' , [Carbon::now()->subMonth() , Carbon::now()->addMonths(1)])->get()),            
            'strutture' => Struttura::with('ambulatori' , 'orariMedici')->get(),
            
            //da spostare in global
            'impostazioni' => [
                'medsport' => true,
                'ambulatoriale' => true,               
                'medico_default_fuori_orario' => null,
                'avviso_presenza_orario_medico' => true,
                'limita_medici_con_orario_medico' => false,
            ],
            'colori' => [
                [
                    'codice' => '#22c55e',
                    'nome' => 'verde'
                ],
                [
                    'codice' => '#f87171',
                    'nome' => 'rosso'
                ],
                [
                    'codice' => '#22d3ee',
                    'nome' => 'blu'
                ],
                [
                    'codice' => '#facc15',
                    'nome' => 'giallo'
                ],
                [
                    'codice' => '#a3a3a3',
                    'nome' => 'grigio'
                ]
            ]
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
