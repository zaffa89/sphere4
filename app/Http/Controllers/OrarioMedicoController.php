<?php

namespace App\Http\Controllers;

use App\Models\Ambulatorio;
use App\Models\OrarioMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrarioMedicoController extends Controller
{

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
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrarioMedico  $orarioMedico
     * @return \Illuminate\Http\Response
     */
    public function show(OrarioMedico $orarioMedico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrarioMedico  $orarioMedico
     * @return \Illuminate\Http\Response
     */
    public function edit(OrarioMedico $orarioMedico)
    {
        
        return $orarioMedico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrarioMedico  $orarioMedico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrarioMedico $orarioMedico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrarioMedico  $orarioMedico
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrarioMedico $orarioMedico)
    {
        //
    }
}
