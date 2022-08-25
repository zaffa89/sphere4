<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Medico;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function generale()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Generale');
    }

    public function utenti()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Utenti' , [
            'utenti' => User::has('sphereUser')->with('sphereUser.medico')->get(),
            'medici_senza_utente' => Medico::doesntHave('sphereUser')->get()
        ]);
    }

    public function impostazioni()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Impostazioni');
    }

    public function notifiche()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Notifiche');
    }

    public function pagamenti()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Pagamenti');
    }

    public function integrazioni()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Integrazioni');
    }

    public function generateUserApiToken(Request $request , User $user)
    {
        $request->validate([
            'token_name' => 'required|string',
            'abilities' => 'required|array|min:1'
        ]);

        return $user->createToken($request->token_name , $request->abilities)->plainTextToken;
    }
    
    public function revokeUserApiToken(User $user , $token_id)
    {
        $user->tokens()->where('id' , $token_id)->delete();
    }
}
