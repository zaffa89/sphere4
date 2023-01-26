<?php

namespace App\Http\Controllers;

use App\Models\VisitaMedsport;
use Inertia\Inertia;
use Illuminate\Http\Request;

class StampeController extends Controller
{
    public function stampaCertificatoAgonistico(VisitaMedsport $visitaMedsport)
    {
        
        return view('certificato' , [
            'data' => $visitaMedsport->load('paziente' , 'sport' , 'medico' , 'prestazione')
        ]);
    }
}
