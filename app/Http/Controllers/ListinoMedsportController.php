<?php

namespace App\Http\Controllers;

use App\Models\ListinoMedsport;
use Exception;
use Illuminate\Http\Request;

class ListinoMedsportController extends Controller
{

    /* METODI PER LE PRESTAZIONI ASSOCIATE */

    public function prestazioniListino(ListinoMedsport $listino)
    {
        return $listino->prestazioni;
    }

    public function attachPrestazione(ListinoMedsport $listino , $id)
    {
        $listino->prestazioni()->syncWithoutDetaching($id);
    }

    public function detachPrestazione(ListinoMedsport $listino , $id)
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
        return ListinoMedsport::with('prestazioni')->orderBy('codice')->get();
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
        ListinoMedsport::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListinoMedsport  $listino
     * @return \Illuminate\Http\Response
     */
    public function show(ListinoMedsport $listino)
    {
        return $listino;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListinoMedsport  $listino
     * @return \Illuminate\Http\Response
     */
    public function edit(ListinoMedsport $listino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListinoMedsport  $listino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListinoMedsport $listino)
    {
        $listino->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListinoMedsport  $listino
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListinoMedsport $listino)
    {       
        return $listino->delete();
    }
}
