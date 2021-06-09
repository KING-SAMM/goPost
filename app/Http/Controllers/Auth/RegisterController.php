<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Make sure not to be able to access Register page when signed in
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
       // Validate request
       $this->validate($request, [
           'name' => 'required|max:255',
           'username' => 'required|max:255',
           'email' => 'required|email|max:255',
           'password' => 'required|confirmed',
       ]);

       // Store user
       User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
       ]);

       //Sign in user
       auth()->attempt($request->only('email', 'password'));

       // Redirect user to dashboard
       return redirect()->route('dashboard');
    }
}
