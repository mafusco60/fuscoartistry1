<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\User;

class RegisterController extends Controller
{
    //@desc show the registration form
    //@route GET /registration
    public function register(): View
    {
    return view('auth.register');
    }

    //@desc save user registration to database
    //@route POST /registration
    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    //Hash the password
        $formFields['password'] = Hash::make($formFields['password']);
    //Create the user
        $user = User::create($formFields);
    //Redirect to login page
        return redirect()->route('login')->with('success', 'You are registered and can now login');    
    }

}