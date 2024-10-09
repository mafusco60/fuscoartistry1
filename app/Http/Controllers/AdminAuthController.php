<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // Admin Login Form
    public function show():View
    {
        return view('/auth/admin-login/show');
    }

    // Admin Authenticate
    public function authenticate(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->intended('/admin-dashboard/index');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        }

        return view('auth/admin-login/show');
    }

  //@desc  Logout Admin
  //@route POST /admin-logout
public function logout(Request $request): RedirectResponse
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/auth/admin-login/show')->with('message', 'You are logged out!');
}
}