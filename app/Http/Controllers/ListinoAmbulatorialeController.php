<?php

namespace App\Http\Controllers;

use App\Models\ListinoAmbulatoriale;
use Illuminate\Http\Request;

class ListinoAmbulatorialeController extends Controller
{

    public function prestazioniListino(ListinoAmbulatoriale $listino)
    {
        return $listino->prestazioni;
    }

    public function attachPrestazione(ListinoAmbulatoriale $listino , $id)
    {
        $listino->prestazioni()->syncWithoutDetaching($id);
    }

    public function detachPrestazione(ListinoAmbulatoriale $listino , $id)
    {
        $listino->prestazioni()->detach($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ListinoAmbulatoriale::orderBy('codice')->get();
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
     * @param  \App\Models\ListinoAmbulatoriale  $listino
     * @return \Illuminate\Http\Response
     */
    public function show(ListinoAmbulatoriale $listino)
    {
        return $listino->load('prestazioni');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListinoAmbulatoriale  $listino
     * @return \Illuminate\Http\Response
     */
    public function edit(ListinoAmbulatoriale $listino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListinoAmbulatoriale  $listino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListinoAmbulatoriale $listino)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListinoAmbulatoriale  $listino
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListinoAmbulatoriale $listino)
    {
        //
    }
}
