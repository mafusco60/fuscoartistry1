<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Admin;

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
        'firstname' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'phone' => 'nullable|string|max:100',
        'email' => 'required|email|max:100|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'subscribe' => 'nullable|boolean',
    ]);

    //Check for admin email addresses
    // $user = new User();
    $adminEmails = Admin::pluck('email')->toArray();

    foreach ($adminEmails as $adminEmail) {
        if ($formFields['email'] == $adminEmail) {
           return redirect()->back()->with('error', 'Email already exists');
        }
    }
  


    //Hash the password
        $formFields['password'] = Hash::make($formFields['password']);



    //Create the user
        $user = User::create($formFields);
    //Redirect to login page
        return redirect()->route('login')->with('success', 'You are registered and can now login');    
    }

}