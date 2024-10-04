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
        'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
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


   /*  public function update(Request $request) : RedirectResponse
    {
        //Get logged in user
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);  
        //Get user name and email
      $user->name = $request->input('name');
        $user->email = $request->input('email');

         //Save the new avatar
         if ($request->hasFile('avatar')) {
            // Get the new avatar
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            $formFields['avatar'] = $avatar->storeAs('avatars', $filename, 'public');
            //Check if a new avatar has been uploaded
            // Delete the old avatar
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }
         */
    

        //Check if user uploaded a new avatar
/*         if($request->hasFile('avatar')) {
            //Delete old avatar
            if($user->avatar){
            Storage::delete($user->avatar);
            }

            $avatar = $request->file('avatar');
                $filename = time() . '_' . $avatar->getClientOriginalName();
                $validatedData['avatar'] = $avatar->storeAs('avatars', $filename, 'public'); */


            //Store new avatar
/*             $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;} */

                        //Save the new image
            /* if ($request->hasFile('avatar')) {
                            // Get the new image
                $avatar = $request->file('avatar');
                $filename = time() . '_' . $avatar->getClientOriginalName();
                $validatedData['avatar'] = $avatar->storeAs('avatars', $filename, 'public');
                //Check if a new image has been uploaded
                // Delete the old image
                 if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                         Storage::disk('public')->delete($user->image);
                    }
                } */
            
            


            //Update user profile
/*             $user->save();

            //Redirect to dashboard with success message
             return redirect()->route('dashboard')->with('success', 'Profile updated successfully'); */
      
    

