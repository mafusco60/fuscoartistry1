<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

use App\Models\User;

class ProfileController extends Controller
{
    // @desc update user profile
    // @route PUT /profile
    public function update(Request $request, User $user)
    {

    // Get the logged in user
    $user = Auth::user();
    $formFields = $request->validate([
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'phone' => 'nullable|string',
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'subscribe' => 'nullable|boolean',
    ]);

    if ($request->hasFile('avatar')) {
        // Get the new avatar
        $avatar = $request->file('avatar');
        $filename = time() . '_' . $avatar->getClientOriginalName();
        $formFields['avatar'] = $avatar->storeAs('avatars', $filename, 'public');

        // Delete the old avatar if it exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
    }

    // Update the user's avatar field
    $user->update($formFields);

    return redirect()->route('dashboard', $user->id)->with('success', 'Profile updated successfully.');
}

}

