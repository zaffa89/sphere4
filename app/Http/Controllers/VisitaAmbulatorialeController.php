<?php

namespace App\Http\Controllers;

use App\Events\VisitaAmbulatorialeAperta;
use App\Models\VisitaAmbulatoriale;
use Illuminate\Http\Request;

class VisitaAmbulatorialeController extends Controller
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
     * @param  \App\Models\VisitaAmbulatoriale  $visitaAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaAmbulatoriale $visitaAmbulatoriale)
    {
        VisitaAmbulatorialeAperta::dispatchIf($visitaAmbulatoriale , $visitaAmbulatoriale , auth()->user()->sphereUser);

        return $visitaAmbulatoriale;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaAmbulatoriale  $visitaAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaAmbulatoriale $visitaAmbulatoriale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaAmbulatoriale  $visitaAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitaAmbulatoriale $visitaAmbulatoriale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaAmbulatoriale  $visitaAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaAmbulatoriale $visitaAmbulatoriale)
    {
        //
    }
}
