<?php

namespace App\Http\Controllers;

use App\Models\Localita;
use Illuminate\Http\Request;

class LocalitaController extends Controller
{

    public function ricerca(Request $request)
    {
        return Localita::where('nome' , 'like' , '%'.$request->ricerca.'%')->orderBy('nome')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Localita::orderBy('nome')->get();
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
     * @param  \App\Models\Localita  $localita
     * @return \Illuminate\Http\Response
     */
    public function show(Localita $localita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localita  $localita
     * @return \Illuminate\Http\Response
     */
    public function edit(Localita $localita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localita  $localita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localita $localita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localita  $localita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localita $localita)
    {
        //
    }
}
