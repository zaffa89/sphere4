<?php

namespace App\Http\Controllers;

use App\Models\Numeratore;
use Illuminate\Http\Request;
use App\Models\NumeratoreDet;

class NumeratoreController extends Controller
{

    public function caricaDet(Numeratore $numeratore) {
        return $numeratore->numeratoreDet;
    }

    public function aggiungiDet(Request $request , Numeratore $numeratore) {
        $numeratore->numeratoreDet()->create([
            'anno' => $request->anno,
            'valore' => $request->valore
        ]);
    }

    public function modificaDet(Request $request , NumeratoreDet $numeratoreDet) {
        $numeratoreDet->update($request->all());
    }

    public function eliminaDet(NumeratoreDet $numeratoreDet) {
        $numeratoreDet->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Numeratore::orderBy('descrizione')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Numeratore::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Numeratore $numeratore
     * @return \Illuminate\Http\Response
     */
    public function show(Numeratore $numeratore)
    {
        return $numeratore;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Numeratore $numeratore
     * @return \Illuminate\Http\Response
     */
    public function edit(Numeratore $numeratore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Numeratore $numeratore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Numeratore $numeratore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Numeratore $numeratore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Numeratore $numeratore)
    {
        //
    }
}