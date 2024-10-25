<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Admin;

class AdminProfileController extends Controller
{
    //@desc Admin Profile
    //@route GET /admin-profiles
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->status == 0) {
            $admin_status = "Inactive";
        } else
        $admin_status = "Active";

        return view('admin-profiles.edit', compact ('admin', 'admin_status'));
    }
    //@desc Admin Profile
    //@route PUT /admin-profiles
    public function update(Request $request, Admin $admin)
    {

    // Get the logged in admin
    $admin = Auth::guard('admin')->user();
    $formFields = $request->validate([
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|string|email',
        'status' => 'required|boolean',
        'type' => 'required|string',
        'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
    ]);




    // Check if the user uploaded a new avatar

    if ($request->hasFile('avatar')) {
        // Get the new avatar
        $avatar = $request->file('avatar');
        $filename = time() . '_' . $avatar->getClientOriginalName();
        $formFields['avatar'] = $avatar->storeAs('avatars', $filename, 'public');

        // Delete the old avatar if it exists
        if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
            Storage::disk('public')->delete($admin->avatar);
        }
    }

    // Update the user's avatar field
    $admin->update($formFields);

    return redirect()->route('admin-profiles.edit', $admin->id)->with('success', 'Profile updated successfully.');
    }
}

