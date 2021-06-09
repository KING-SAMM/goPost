<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Make sure not to be able to access login page when signed in
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Sign in user
       if (!auth()->attempt($request->only('email', 'password'), $request->remember))
       {
           return back()->with('status', 'Invalid login details');
       }

       return redirect()->route('dashboard');
    }
}
