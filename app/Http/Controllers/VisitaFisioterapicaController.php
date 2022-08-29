<?php

namespace App\Http\Controllers;

use App\Events\VisitaFisioterapicaAperta;
use App\Models\VisitaFisioterapica;
use Illuminate\Http\Request;

class VisitaFisioterapicaController extends Controller
{
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
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaFisioterapica $visitaFisioterapica)
    {
        VisitaFisioterapicaAperta::dispatchIf($visitaFisioterapica , $visitaFisioterapica , auth()->user()->sphereUser);

        return $visitaFisioterapica;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaFisioterapica $visitaFisioterapica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitaFisioterapica $visitaFisioterapica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaFisioterapica  $visitaFisioterapica
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaFisioterapica $visitaFisioterapica)
    {
        //
    }
}
