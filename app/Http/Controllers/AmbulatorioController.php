<?php

namespace App\Http\Controllers;

use App\Models\Ambulatorio;
use Illuminate\Http\Request;

class AmbulatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ambulatorio::all();
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
        $ambulatorio = Ambulatorio::create($request->all());
        return $ambulatorio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ambulatorio  $ambulatorio
     * @return \Illuminate\Http\Response
     */
    public function show(Ambulatorio $ambulatorio)
    {
        return $ambulatorio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ambulatorio  $ambulatorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambulatorio $ambulatorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambulatorio  $ambulatorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambulatorio $ambulatorio)
    {
        $ambulatorio->update($request->all());
        return $ambulatorio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ambulatorio  $ambulatorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambulatorio $ambulatorio)
    {
        $ambulatorio->delete();
    }
}
