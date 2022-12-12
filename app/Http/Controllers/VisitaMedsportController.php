<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitaMedsport;
use Illuminate\Support\Facades\DB;
use App\Events\VisitaMedsportVisualizzata;
use App\Events\VisitaMedsportModificata;

class VisitaMedsportController extends Controller
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
        //90000630195 cod fiscale interfulmina
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function show(VisitaMedsport $visitaMedsport)
    {
        VisitaMedsportVisualizzata::dispatchIf($visitaMedsport , $visitaMedsport , auth()->user()->sphereUser);

        return $visitaMedsport;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitaMedsport $visitaMedsport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitaMedsport $visitaMedsport)
    {
        //aggiungere validazione

        DB::transaction(function () use ($request , $visitaMedsport) {
            
         
            
            VisitaMedsportModificata::dispatchIf($visitaMedsport->isDirty() , $visitaMedsport , auth()->user()->sphereUser);
            $visitaMedsport->save();
        });
        

        return $visitaMedsport;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitaMedsport  $visitaMedsport
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitaMedsport $visitaMedsport)
    {
        //
    }
}
