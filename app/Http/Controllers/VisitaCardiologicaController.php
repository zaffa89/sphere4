<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitaCardiologica;
use Illuminate\Support\Facades\DB;
use App\Events\VisitaCardiologicaVisualizzata;
use App\Events\VisitaCardiologicaModificata;

class VisitaCardiologicaController extends Controller
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
     * @param  \App\Models\VisitaCardiologica  $visitaCardiologica
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaCardiologica $visitaCardiologica)
    {
        VisitaCardiologicaVisualizzata::dispatchIf($visitaCardiologica , $visitaCardiologica , auth()->user()->sphereUser);

        return $visitaCardiologica;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaCardiologica  $visitaCardiologica
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaCardiologica $visitaCardiologica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaCardiologica  $visitaCardiologica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitaCardiologica $visitaCardiologica)
    {
        //aggiungere validazione

        DB::transaction(function () use ($request , $visitaCardiologica) {
            
            //$prenotazione->data_visita = $request->data_visita;
            
            VisitaCardiologicaModificata::dispatchIf($visitaCardiologica->isDirty() , $visitaCardiologica , auth()->user()->sphereUser);
            $visitaCardiologica->save();
        });
        

        return $visitaCardiologica;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaCardiologica  $visitaCardiologica
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaCardiologica $visitaCardiologica)
    {
        //
    }
}
