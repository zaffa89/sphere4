<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VisitaFisioterapica;
use App\Events\VisitaFisioterapicaVisualizzata;
use App\Events\VisitaFisioterapicaModificata;

class VisitaFisioterapicaController extends Controller
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
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaFisioterapica $visitaFisioterapica)
    {
        VisitaFisioterapicaVisualizzata::dispatchIf($visitaFisioterapica , $visitaFisioterapica , auth()->user()->sphereUser);

        return $visitaFisioterapica;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaFisioterapica $visitaFisioterapica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitaFisioterapica $visitaFisioterapica)
    {
        //aggiungere validazione

        DB::transaction(function () use ($request , $visitaFisioterapica) {
            
        
            
            VisitaFisioterapicaModificata::dispatchIf($visitaFisioterapica->isDirty() , $visitaFisioterapica , auth()->user()->sphereUser);
            $visitaFisioterapica->save();
        });
        

        return $visitaFisioterapica;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaFisioterapica $visitaFisioterapica)
    {
        //
    }
}
