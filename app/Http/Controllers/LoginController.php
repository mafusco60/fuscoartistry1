<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   
        //@desc show the login form
        //@route GET /login
    public function login(): View
    {  
       
        $path = request()->path();
        return view('auth.login', ['path' => $path]);
    }

    //@desc authenticate user or admin
    //@route POST /login
    public function authenticate(Request $request)
  
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

    //Validate the user
        $credentials = $request->validate([
        'email' => 'required|email|max:100',
        'password' => 'required|string',
    ]);
    //Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        //Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();
    //Redirect to the intended page
    return redirect()->intended()->with('success', 'You are logged in!');     
    
    
    //Login the admin
}
if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
    return redirect()->intended('/admin-dashboard');
} else {
    return redirect()->back()->with('error', 'Invalid Email or Password');
}

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    return redirect()->intended('/admin-dashboard');
    //If auth fails return back to login page
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
        } 
     return redirect()->intended()->with('success', 'You are logged in!'); 
        }

    

        //@desc logout user
        //@route POST /logout
        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You are logged out!');
        }
    
    }
   

    







    

