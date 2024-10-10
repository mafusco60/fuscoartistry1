<?php
namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    // Show the form to create a new message from the home page
    public function create(): View
    {
        return view('messages.create');
    }

    // Show the form to create a new message from the artwork view
    public function createFromArtwork(Artwork $artwork): View
    {
        return view('messages.create', ['artwork' => $artwork]);
    }

    // Save the message to the database from the home page
    public function store(Request $request): RedirectResponse
    {
        // Validate the form fields
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image in the public/uploads folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $formFields['image'] = $image->storeAs('uploads', $filename, 'public');
        }

        // Add additional fields
        $formFields['sender_id'] = Auth::id();
        $formFields['artwork_id'] = $request->input('artwork_id');

        // Save the message to the database
        Message::create($formFields);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // Save the message to the database from the artwork view
    public function storeFromArtwork(Request $request, Artwork $artwork): RedirectResponse
    {
        // Validate the form fields
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image in the public/uploads folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $formFields['image'] = $image->storeAs('uploads', $filename, 'public');
        }

        // Add additional fields
        $formFields['sender_id'] = Auth::id();
        $formFields['artwork_id'] = $artwork->id;

        // Save the message to the database
        Message::create($formFields);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    //Show all messages
  

    public function index()
    {
        $messages = Message::latest()->with('user','artwork')->get();
        return view('messages.index', compact('messages'));
    }
}
    // @desc save the message to database
    // @route POST /artworks/{artwork}/message
  /*   public function store(Request $request, Artwork $artwork): RedirectResponse
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
      
        

        $formFields['sender_id'] = Auth::id();
        $formFields['artwork_id'] = $artwork->id;



        // Save the message to the database
        
        Message::create($formFields);

        

    return redirect()->back()->with('success', 'Message sent successfully');
} */



 // @desc save the message to database
    // @route POST /artworks/{artwork}/message
    /* public function artwork_store(Request $request, Artwork $artwork): RedirectResponse
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
      
        

        $formFields['sender_id'] = Auth::id();
        $formFields['artwork_id'] = $artwork->id;



        // Save the message to the database
        
        Message::create($formFields);

        

    return redirect()->back()->with('success', 'Message sent successfully');
} */

