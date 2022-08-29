<?php

namespace App\Http\Controllers;

use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\PrenotazioneModificata;

class PrenotazioneController extends Controller
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
        //
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
        //
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
        

        DB::transaction(function () use ($request , $prenotazione) {
            $prenotazione->data_visita = $request->data_visita;

            PrenotazioneModificata::dispatchIf($prenotazione->isDirty() , $prenotazione , auth()->user()->sphereUser);
            $prenotazione->save();

            return $prenotazione;
        });
        

        return $prenotazione;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prenotazione $prenotazione)
    {
        //
    }
}
