<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   
        //@desc show the login form
        //@route GET /login
public function login(): View
    {
        return view('auth.login');
    }

    //@desc authenticate user
    //@route POST /login
    public function authenticate(Request $request): RedirectResponse
  
    {
        $credentials = $request->validate([
        'email' => 'required|email|max:100',
        'password' => 'required|string',
    ]);
    //Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        //Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

    //Redirect to the intended page
         return redirect()->intended()->with('success', 'You are logged in!'); 
    }
    //If auth fails return back to login page
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
            
    }
    //@desc logout user
        //@route POST /logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success', 'You are logged out!');
    }

}
