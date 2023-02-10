<?php

namespace App\Http\Controllers;

use App\Models\PrestazioneMedsport;
use Illuminate\Http\Request;

class PrestazioneMedsportController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PrestazioneMedsport::orderBy('codice')->get();
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
        PrestazioneMedsport::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  PrestazioneMedsport $prestazioneMedsport
     * @return \Illuminate\Http\Response
     */
    public function show(PrestazioneMedsport $prestazioneMedsport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  PrestazioneMedsport $prestazioneMedsport
     * @return \Illuminate\Http\Response
     */
    public function edit(PrestazioneMedsport $prestazioneMedsport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PrestazioneMedsport $prestazioneMedsport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrestazioneMedsport $prestazioneMedsport)
    {
        $prestazioneMedsport->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  PrestazioneMedsport $prestazioneMedsport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrestazioneMedsport $prestazioneMedsport)
    {       
        $prestazioneMedsport->delete();
    }
}
