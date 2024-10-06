<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Artwork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
   /*  public function index()
    {   
        $messages = Message::latest()->paginate(9);
        
        return view('messages.index')->with('messages', $messages);

    }
    public function create()
    {
        return view('messages.create');
    } */
    public function store(Request $request, Artwork $artwork): RedirectResponse
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'subject' => 'required',
            'body' => 'required',
            'archived' => 'nullable',
            'reply' => 'nullable',
            'read' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        
        ]);

        
            //Save the new image
            if ($request->hasFile('image')) {
                // Get the new image
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $formFields['image'] = $image->storeAs('uploads', $filename, 'public');
            }
      
        // Create a new message instance

        $message = new Message($formFields);
        
        $formFields['sender_id'] = Auth::id();
        $formFields['artwork_id'] = $artwork->id;

        // Save the message to the database
        Message::create($formFields);

        

    return redirect()->back()->with('success', 'Message sent successfully');
}

}