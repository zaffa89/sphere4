<?php

namespace App\Http\Controllers;

use App\Models\PrestazioneAmbulatoriale;
use Illuminate\Http\Request;

class PrestazioneAmbulatorialeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PrestazioneAmbulatoriale::orderBy('codice')->get();
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
     * @param  \App\Models\PrestazioneAmbulatoriale  $prestazioneAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function show(PrestazioneAmbulatoriale $prestazioneAmbulatoriale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrestazioneAmbulatoriale  $prestazioneAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function edit(PrestazioneAmbulatoriale $prestazioneAmbulatoriale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrestazioneAmbulatoriale  $prestazioneAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrestazioneAmbulatoriale $prestazioneAmbulatoriale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrestazioneAmbulatoriale  $prestazioneAmbulatoriale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrestazioneAmbulatoriale $prestazioneAmbulatoriale)
    {
        //
    }
}
