<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medico;
use App\Models\SphereUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class SphereUserController extends Controller
{

    /*
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $sphereUser = SphereUser::where('username', $request->username)->first();
 
        if (! $sphereUser || ! Hash::check($request->password, $sphereUser->password)) {
            return response([
                'username' => 'Login non abilitato.'
            ], 403);            
        }

        $mainUser = User::find(1); //utenza sphere
        
        $mainUser->tokens()->where('name' , $sphereUser->username)->delete();
        
        $token = $mainUser->createToken($request->username , ['admin']);
        $sphereUser->token_id = $token->accessToken->id;
        $sphereUser->save();

        return $token->plainTextToken;
        //return $sphereUser;
    }
    */
    public function checkAuth(Request $request)
    {
        return auth()->user()->username;
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
            'admin' => 'required|boolean',
            'attivo' => 'required|boolean',
            'medico_id' => 'nullable|exists:medici,id'      
        ]);

        //genera mail e/o telefono come placeholder
        $request->email = $request->email ?: 'temp' . Str::random(5) . '@solutionmed.it';
        $request->telefono = $request->telefono ?: '0000000000';

        $user = User::firstOrCreate(
            [
                'email' => $request->email
            ],
            [
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono
            ]);
        
        if( $user->sphereUser()->exists() ) {
            return response('Questo utente è già associato ad un profilo Sphere' , 422);
        }
        else {
            $user->sphereUser()->create($request->only(['username' , 'admin' , 'attivo']));
            
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
    public function show(SphereUser $sphereUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SphereUser  $sphereUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SphereUser $sphereUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SphereUser  $sphereUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SphereUser $sphereUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SphereUser  $sphereUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SphereUser $sphereUser)
    {
        //
    }
}
