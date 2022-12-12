<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Medico;
use App\Models\Struttura;
use App\Models\Ambulatorio;
use App\Models\OrarioMedico;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use App\Events\PrenotazioneCreata;
use App\Models\VisitaCardiologica;
use Illuminate\Support\Facades\DB;
use App\Models\PrestazioneMedsport;
use App\Models\VisitaAmbulatoriale;
use App\Models\VisitaFisioterapica;
use App\Events\PrenotazioneEliminata;
use App\Events\PrenotazioneModificata;
use App\Models\PrestazioneCardiologica;
use App\Events\PrenotazioneVisualizzata;
use App\Models\PrestazioneAmbulatoriale;
use App\Models\PrestazioneFisioterapica;

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
     * Show the form for creating a new resource. deamici leonardo 14/10
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $request->validate([
            'data_inizio' => 'required',
            'data_fine' => 'required',
            'struttura_id' => 'required',
            'ambulatorio_id' => 'required',
            'medico_id' => 'nullable',
            'visita_type' => 'nullable',
        ]);
                
        //$prenotazione = new Prenotazione($request->all());        
        $prenotazione = new Prenotazione([
            'data_inizio' => $request->data_inizio,
            'data_fine' => $request->data_fine,
            'struttura_id' => $request->struttura_id,
            'ambulatorio_id' => $request->ambulatorio_id,
            'medico_id' => $request->medico_id,
            'visita_type' => $request->visita_type,
            'blocco' => $request->blocco
        ]);

        $prestazioni = [];
        $elenco_sport = [];
        switch($request->visita_type)
        {
            case 'medsport':
                $prenotazione->visita = new VisitaMedsport();
                $prestazioni = PrestazioneMedsport::with('sottoprestazioni')->get();
                $elenco_sport = Sport::all();
                break;

                case 'ambulatoriale':
                    $prenotazione->visita = new VisitaAmbulatoriale();
                    $prestazioni = PrestazioneAmbulatoriale::all();
                    break;
                    
                    case 'cardiologica':
                        $prenotazione->visita = new VisitaCardiologica();
                        $prestazioni = PrestazioneCardiologica::all();
                        break;

                        case 'fisioterapica':
                            $prenotazione->visita = new VisitaFisioterapica();
                            $prestazioni = PrestazioneFisioterapica::all();
                            break;                            
        }
        
        return [
            'prenotazione' => $prenotazione,          
            'prestazioni' => $prestazioni,
            'elenco_sport' => $elenco_sport,
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
    public function store(Request $request)
    {
        $request->validate([
            'visita_type' => 'nullable',        
            'data_inizio' => 'required',
            'data_fine' => 'required',
            'struttura_id' => 'required',
            'ambulatorio_id' => 'required',
            'paziente_id' => 'required_unless:visita_type,null|integer',
            'medico_id' => 'required_unless:visita_type,null',
            'note' => 'nullable|max:255',
            'durata' => 'required|integer|min:5',
            'visita.prestazione_id' => 'required_unless:visita_type,null|integer',
        ]);      
        
        return DB::transaction(function () use ($request) {
            $prenotazione = Prenotazione::create([
                'sphere_user_id' => auth()->user()->sphereUser->id,
                'paziente_id' => $request->paziente_id,
                'medico_id' => $request->medico_id,
                'ambulatorio_id' => $request->ambulatorio_id,
                'struttura_id' => $request->struttura_id,
                'data_prenotazione' => now(),
                'data_inizio' => Carbon::parse($request->data_inizio),
                'data_fine' => Carbon::parse($request->data_inizio)->addMinutes($request->durata),
                'note' => $request->note,
                'blocco' => $request->blocco,
                'accettata' => false
            ]);
            
            $visita = match( $request->visita_type ) {
                'medsport' => VisitaMedsport::create(['prestazione_id' => $request->visita['prestazione_id']]),
                'ambulatoriale' => VisitaAmbulatoriale::create(['prestazione_id' => $request->visita['prestazione_id']]),
                'cardiologica' => VisitaCardiologica::create(['prestazione_id' => $request->visita['prestazione_id']]),
                'fisioterapica' => VisitaFisioterapica::create(['prestazione_id' => $request->visita['prestazione_id']]),
                default => null
            };
            
            if( $visita ) {
                $prenotazione->visita()->associate($visita); 
                $prenotazione->save();
            }

            PrenotazioneCreata::dispatchIf($prenotazione , $prenotazione , auth()->user()->sphereUser , $request->header('Electron-Client-UUID'));

            //return new PrenotazioneCalendarioResource($prenotazione);
            return $prenotazione->load('paziente');
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
    public function edit(Prenotazione $prenotazione)
    {
        $prestazioni = match ($prenotazione->visita_type) {
            'medsport' => PrestazioneMedsport::with('sottoprestazioni')->get(),
            'ambulatoriale' => PrestazioneAmbulatoriale::all(),
            'cardiologica' => PrestazioneCardiologica::all(),
            'fisioterapica' => PrestazioneFisioterapica::all(),
            default => null
        };

   
        return [
            'prenotazione' => $prenotazione->load('visita.prestazione' , 'paziente.localitaNascita' , 'paziente.localitaResidenza' , 'paziente.localitaRilascioDocumento'),
            'prestazioni' => $prestazioni,
            'elenco_sport' => $prenotazione->visita_type === 'medsport' ? Sport::all() : [],
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
    public function update(Request $request, Prenotazione $prenotazione)
    {
        //aggiungere validazione
        $request->validate([
            'visita_type' => 'nullable',         
            'data_inizio' => 'required',
            'data_fine' => 'required',
            'durata' => 'required|integer|gte:1',
            'struttura_id' => 'required',
            'ambulatorio_id' => 'required',
           // 'paziente_id' => 'required_unless:visita_type,null|integer',
            'medico_id' => 'required_unless:visita_type,null',
            'note' => 'nullable|max:255',
            'visita.prestazione_id' => 'required_unless:visita_type,null|integer'          
        ]);

        return DB::transaction(function () use ($request , $prenotazione) {
            //nuovo metodo:
            //duplica in tabella backup
            //esegui update
            //manda notifica usando sia vecchio che nuovo
            //ritorna risposta
            
            $oldPrenotazione = $prenotazione->toArray();
            
            $prenotazione->data_inizio = Carbon::parse($request->data_inizio)->format('Y-m-d H:i:s');
            $prenotazione->data_fine = Carbon::parse($request->data_inizio)->addMinutes($request->durata)->format('Y-m-d H:i:s');           
            
            $prenotazione->ambulatorio_id = $request->ambulatorio_id;
            $prenotazione->struttura_id = $request->struttura_id;

            $visitaDirty = false;
            if($prenotazione->visita_type) {
                $prenotazione->medico_id = $request->medico_id;
                $prenotazione->visita->prestazione_id = $request->visita['prestazione_id'];
                $visitaDirty = $prenotazione->visita->isDirty();
            }
            $isDirty = $prenotazione->isDirty();
            
            $prenotazione->push();
            
            //PrenotazioneModificata::dispatchIf($isDirty , $prenotazione , $oldPrenotazione , auth()->user()->sphereUser , $request->header('Electron-Client-UUID'));         
            //return new PrenotazioneCalendarioResource($prenotazione);
            return $prenotazione->load('paziente');
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
            //sistema di backup da rifare come in update

            $prenotazione->update([
               'data_inizio' => Carbon::parse($request->data_inizio),
               'data_fine' => Carbon::parse($request->data_fine),
               'ambulatorio_id' => $request->ambulatorio_id,
               'medico_id' => $request->medico_id 
            ]);
            //return new PrenotazioneCalendarioResource($prenotazione);
            return $prenotazione->load('paziente');
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
            PrenotazioneEliminata::dispatchIf($prenotazione , $prenotazione , auth()->user()->sphereUser , $request->header('Electron-Client-UUID'));
            $prenotazione->delete();
        });
        
        return $prenotazione->trashed();
    }
}
