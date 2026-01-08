<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkAuth(Request $request)
    {
        $login = $request->input('email');
        $pass = $request->input('password');
        if(count(User::where('email', '=', $login)->where('password', '=', $pass)->get())==0) {
            return view('auth')->with(['error'=>'auth pb']);
        }
        
        $request->session()->put('login', $login);
        return redirect()->route('students');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('login');
        return redirect()->route('auth');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
