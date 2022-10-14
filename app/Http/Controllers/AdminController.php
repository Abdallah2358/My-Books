<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    
    /* 
    display login view 
    */
    public function loginView()
    {
    
        return view('admins.login' );
    }

    /* 
    submit login data 
    */
    public function login()
    {
        $attributes = request()->validate(
            [
                'email' => ['required', 'max:255', 'email'],
                'password' => ['required', 'max:255', 'min:7'],
            ]
        );
        if (Auth::attempt($attributes)) { 
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome, Back!');
        }
        return back()
            ->withErrors(['email' => 'Yor credential could not be verified']);
    }


    //logout 
    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Good bye');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = request()->validate(
            [
                'name' => ['required', 'max:255', 'min:3'],
                'email' => ['required', 'max:255', 'email', 'unique:users,email'],
                'password' => ['required', 'max:255', 'min:7'],
                'phone' => ['required','digits_between:10,50', 'unique:users,phone']
            ]
        );
      
        //persisting the data
        $admin = User::create($admin);
        //authenticate the user after creating him
        Auth::login($admin);
        //flashing a message on successful registration
        return redirect('/')->with('success', 'You have Been Registered');
    }

}
