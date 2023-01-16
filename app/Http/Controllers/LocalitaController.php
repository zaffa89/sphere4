<?php

namespace App\Http\Controllers;

use App\Models\Localita;
use Illuminate\Http\Request;

class LocalitaController extends Controller
{
    public function ricerca($queryRicerca)
    {
        return $queryRicerca ? Localita::where('nome' , 'like' , '%'.$queryRicerca.'%')->orderBy('nome')->limit(10)->get() : [];
    }

    public function cercaTramiteCodiceCatastale($codice)
    {
        return Localita::where('codice_catastale' , $codice)->first();
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
     * @param  \App\Models\Localita  $localitum
     * @return \Illuminate\Http\Response
     */
    public function show(Localita $localitum)
    {
        return $localitum;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localita  $localitum
     * @return \Illuminate\Http\Response
     */
    public function edit(Localita $localitum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localita  $localitum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localita $localitum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localita  $localitum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localita $localitum)
    {
        //
    }
}
