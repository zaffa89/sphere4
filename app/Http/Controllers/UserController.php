<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Medico;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function clientLoginForm(Request $request)
    {
        return Inertia::render('Sphere/Login' , [
            'token' => $request->header('Authorization')
        ]);
    }

    public function externalLoginForm()
    {
        //eventuale blocco
        return Inertia::render('Sphere/ExternalLoginForm');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('username' , $request->username)->first();

        if( $user && $user->attivo )
        {
            if( Auth::attempt( ['username' => $request->username , 'password' => $request->password] ) )
            {
               // $user->tokens()->delete();
                //$token = $user->createToken($request->username , ['sphere-client']);
              
                return redirect()->intended('/');
            }            
        }
        if( $user && !$user->attivo)
        {
            return back()->withErrors([
                'message' => 'Questo utente è stato disabilitato'
            ])->onlyInput('username');
            //return response()->json( ['message' => 'Questo utente è stato disabilitato'] , 401 );
        }
        //return response()->json( ['message' => 'Nome utente o password errati'] , 401 );
        return back()->withErrors([
            'message' => 'Nome utente o password errati'
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->action([UserController::class , 'clientLoginForm']);
    }

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
        $request->validate([
            'username' => 'string|required',
            'password' => 'string|required|confirmed', //password_confirmation 
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string',
            'attivo' => 'required|boolean',
            'user_role_id' => 'nullable|exists:user_roles,id',
            'medico_id' => 'nullable|exists:medici,id'      
        ]);

        //genera mail e/o telefono come placeholder
        $request->email = $request->email ?: 'temp' . Str::random(5) . '@solutionmed.it';
        $request->telefono = $request->telefono ?: '0000000000';

        $user = User::firstOrCreate(
            [
                'username' => $request->username
            ],
            [
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono
            ]);
        
        if( $user->sphereUser()->exists() ) {
            return response('Questo utente è già associato ad un profilo Sphere' , 422);
        }
        else {
            $user->sphereUser()->create($request->only(['username' , 'user_role_id' , 'attivo']));
            
            if( $request->medico_id ) {
                $medico = Medico::find($request->medico_id);
                $medico->sphereUser()->associate($user);
                $medico->save();
            }
            
            return $user;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SphereUser  $sphereUser
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SphereUser  $sphereUser
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
