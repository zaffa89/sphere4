<?php

namespace App\Http\Controllers;

use App\Models\SocietaSportiva;
use Illuminate\Http\Request;

class SocietaSportivaController extends Controller
{

    public function search(Request $request)
    {
        $request->validate([
            'ricerca' => 'nullable|string'
        ]);

        return response()->json(SocietaSportiva::where('ragione_sociale' , 'like' , '%'.$request->ricerca.'%')->orderBy('ragione_sociale')->limit(20)->get() , 200);
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
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function show(SocietaSportiva $societaSportiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function edit(SocietaSportiva $societaSportiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocietaSportiva $societaSportiva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocietaSportiva $societaSportiva)
    {
        //
    }
}
