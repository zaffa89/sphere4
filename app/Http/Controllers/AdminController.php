<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Medico;
use App\Models\Setting;
use App\Models\UserRole;
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
            'utenti' => User::with('medico' , 'role')->get(),
            'medici_senza_utente' => Medico::doesntHave('user')->get(),
            'ruoli' => UserRole::all()
        ]);
    }

    public function impostazioni()
    {
        $this->authorize('solutionmed');

        $settings = Setting::all();
        $settingsObject = [];
        foreach($settings as $key => $value)
        {
            $settingsObject[$value->attribute] = $value;
        }
        
        return Inertia::render('Admin/Impostazioni' , [
            'settings' => config('settings')
        ]);
    }

    public function saveSetting(Request $request , Setting $setting)
    {
        $setting->update([
            'value' => $request->all()
        ]);
        return $setting;
    }

    public function notifiche()
    {
        $this->authorize('solutionmed');

        return Inertia::render('Admin/Notifiche' , [
            'settings' => config('settings')
        ]);
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
