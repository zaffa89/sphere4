<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Paziente;
use App\Models\Ambulatorio;
use Illuminate\Http\Request;

class FormSphereController extends Controller
{
    public function mainForm() {

        return Inertia::render('Sphere/FormContainer');
    }

    public function formPazienti()
    {
        return Inertia::render('Sphere/FormPazienti' , [
            'pazienti' => Paziente::inRandomOrder()->with('localitaNascita' , 'localitaResidenza')->orderBy('id')->limit(5)->get()
        ]);
    }

    public function formAmbulatori()
    {
        return Inertia::render('Sphere/FormAmbulatori' , [
            'ambulatori' => Ambulatorio::all()
        ]);
    }
}
