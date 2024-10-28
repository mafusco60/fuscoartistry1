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
    // Get the logged in user
    
    $admin = Auth::guard('admin')->user();
    
    $formFields = $request->validate([
        'name' => 'nullable|string',
        'firstname' => 'nullable|string',
        'lastname' => 'nullable|string',
        'email' => 'required|string|email',
        'status' => 'nullable|boolean',
        'type' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        'phone' => 'nullable|string',
    ]);

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

    // Update the admin's  fields
    $admin->update($formFields);

    return redirect()->route('admin-profiles.edit')->with('success', 'Profile updated successfully.');

}
}
