<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateSportRequest;
use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function sportTramiteTipoVisita($tipoVisita) {
        return Sport::where('tipo_visita' , $tipoVisita)->orderBy('nome')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sport::orderBy('nome')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return new Sport();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateSportRequest $request)
    {
        $sport = Sport::create($request->safe()->all());

        return $sport;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport)
    {
        return $sport;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateSportRequest $request, Sport $sport)
    {        
        $sport->update($request->safe()->all());

        return $sport;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
    }
}
