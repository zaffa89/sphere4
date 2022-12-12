<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{

    public function ricercaMedico(Request $request)
    {
        $request->validate([
            'ricerca' => 'nullable|string'
        ]);
        
        return Medico::where('ragione_sociale' , 'like' , '%'.strtolower(trim($request->ricerca)).'%')->orderBy('ragione_sociale')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medico::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return new Medico();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ragione_sociale' => 'required',
            'codice_fiscale' => 'nullable',
            'telefono' => 'nullable|string|max:15',
            'telefono_fisso' => 'nullable|string|max:15',
            'email' => 'nullable|email',

            'colore' => 'nullable',
            'partita_iva' => 'nullable',
            'identificativo_fmsi' => 'nullable',
            'codice_tracciato' => 'nullable',
            'timbro' => 'nullable',
            
            'abilitazione_medsport' => 'boolean',
            'abilitazione_ambulatoriale' => 'boolean',
            'abilitazione_cardiologia' => 'boolean',
            'abilitazione_fisioterapia' => 'boolean',

            'attivo' => 'boolean'            
        ]);
        
        $medico = Medico::create($request->all());
        
        return $medico;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        return $medico;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        return $medico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
        //aggiungere validazione
        $request->validate([
            'ragione_sociale' => 'required',
            'codice_fiscale' => 'nullable',
            'telefono' => 'nullable|string|max:15',
            'telefono_fisso' => 'nullable|string|max:15',
            'email' => 'nullable|email',

            'colore' => 'nullable',
            'partita_iva' => 'nullable',
            'identificativo_fmsi' => 'nullable',
            'codice_tracciato' => 'nullable',
            'timbro' => 'nullable',
            
            'abilitazione_medsport' => 'boolean',
            'abilitazione_ambulatoriale' => 'boolean',
            'abilitazione_cardiologia' => 'boolean',
            'abilitazione_fisioterapia' => 'boolean',

            'attivo' => 'boolean'            
        ]);

    DB::transaction(function () use ($request , $medico) {            
        $medico->update($request->all());
    });
            
    return $medico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
    }
}
