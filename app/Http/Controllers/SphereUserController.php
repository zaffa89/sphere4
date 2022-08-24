<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SphereUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class SphereUserController extends Controller
{

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
        //
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
