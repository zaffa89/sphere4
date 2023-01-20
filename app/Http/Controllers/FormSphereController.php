<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Paziente;
use Illuminate\Http\Request;

class FormSphereController extends Controller
{
    public function mainForm() {

        return Inertia::render('Sphere/MainForm');
    }

    public function formPazienti()
    {
        return Inertia::render('Sphere/FormPazienti' , [
            'pazienti' => Paziente::inRandomOrder()->with('localitaNascita' , 'localitaResidenza')->orderBy('id')->limit(5)->get()
        ]);
    }
}
