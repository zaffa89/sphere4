<?php

namespace App\Http\Controllers\Online\Prenotazione;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index () {
        return Inertia::render('Homepage');
    }
}
