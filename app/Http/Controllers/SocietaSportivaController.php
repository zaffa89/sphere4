<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateSocietaSportivaRequest;
use App\Models\SocietaSportiva;
use Illuminate\Http\Request;

class SocietaSportivaController extends Controller
{
    /* POST
    public function ricercaSocieta(Request $request)
    {
        $request->validate([
            'ricerca' => 'nullable|string'
        ]);

        return response()->json(SocietaSportiva::where('ragione_sociale' , 'like' , '%'.$request->ricerca.'%')->orderBy('ragione_sociale')->limit(20)->get() , 200);
    }
    */
    public function ricercaSocieta($queryRicerca)
    {       
        return $queryRicerca ? response()->json(SocietaSportiva::where('ragione_sociale' , 'like' , '%'.$queryRicerca.'%')->orderBy('ragione_sociale')->limit(20)->get() , 200) : [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SocietaSportiva::with('localita')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return new SocietaSportiva();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateSocietaSportivaRequest $request)
    {
        $societaSportiva = SocietaSportiva::create($request->safe()->all());

        return $societaSportiva;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function show(SocietaSportiva $societaSportiva)
    {
        return $societaSportiva;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function edit(SocietaSportiva $societaSportiva)
    {
        return $societaSportiva;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocietaSportiva  $societaSportiva
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateSocietaSportivaRequest $request, SocietaSportiva $societaSportiva)
    {
        $societaSportiva->update($request->safe()->all());

        return $societaSportiva;
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
