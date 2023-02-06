<?php

namespace App\Http\Controllers;

use App\Models\VisitaMedsport;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\WebClientPrint\WebClientPrint;

class StampeController extends Controller
{
    public function certificatoNonAgonistico(VisitaMedsport $visitaMedsport)
    {
        /*
        return Inertia::render('Sphere/Stampe/CertificatoNonAgonistico' , [
            'data' => $visitaMedsport->load('paziente' , 'sport' , 'medico' , 'prestazione')
        ]);
        */
        return view('certificatoNonAgonistico' , [
            'data' => $visitaMedsport->load('paziente.localitaNascita' , 'medico' , 'prestazione' , 'societaSportiva')
        ]);        
    }

    public function certificatoRosso(VisitaMedsport $visitaMedsport)
    {
        /*
        return Inertia::render('Sphere/Stampe/CertificatoNonAgonistico' , [
            'data' => $visitaMedsport->load('paziente' , 'sport' , 'medico' , 'prestazione')
        ]);
        */
        return view('certificatoRosso' , [
            'data' => $visitaMedsport->load('paziente.localitaNascita' , 'sport' , 'medico' , 'prestazione' , 'societaSportiva')
        ]);        
    }

    public function certificatoGiallo(VisitaMedsport $visitaMedsport)
    {
        /*
        return Inertia::render('Sphere/Stampe/CertificatoNonAgonistico' , [
            'data' => $visitaMedsport->load('paziente' , 'sport' , 'medico' , 'prestazione')
        ]);
        */
        return view('certificatoGiallo' , [
            'data' => $visitaMedsport->load('paziente.localitaNascita' , 'paziente.localitaResidenza' , 'sport' , 'medico' , 'prestazione' , 'societaSportiva')
        ]);        
    }

    public function schedaAtleta(VisitaMedsport $visitaMedsport)
    {

        return view('schedaAtleta' , [
            'data' => $visitaMedsport->load('paziente' , 'sport' , 'datiClinici' , 'preAnamnesi')
        ]);
    }
}
