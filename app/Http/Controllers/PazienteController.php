<?php

namespace App\Http\Controllers;

use App\Events\PazienteAperto;
use App\Models\Paziente;
use Illuminate\Http\Request;

class PazienteController extends Controller
{

    public function provaMorph()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Paziente::all();
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
        $paziente = Paziente::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function show(Paziente $paziente)
    {

        PazienteAperto::dispatchIf($paziente , $paziente , auth()->user()->sphereUser);

        return $paziente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paziente $paziente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paziente $paziente)
    {
        return $paziente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paziente $paziente)
    {
        $paziente->delete();
    }
}
