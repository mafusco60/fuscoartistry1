<?php
namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Message;
use App\Models\ArchiveMessage;
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
        $messages = new Message();
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

        return redirect()->back()->with('messages', $messages, 'success', 'Message sent successfully!');
    }

    //Show all messages
    public function index(): View
    {
        $messages = Message::latest()->with('user','artwork')->get();
        return view ('messages.index', compact('messages'));
    }

    //View Reply form
    public function edit(Message $message): View
    {
        return view('messages.edit')->with('message', $message);
    }

    public function update(Request $request, $id)
 {
     // Validate the request
     $request->validate([
         'reply' => 'required|string',
     ]);
 
     // Find the  message by ID
     $message = Message::findOrFail($id);
 
     // Update the reply
     $message->reply = $request->input('reply');
     $message->save();
 
     // Return a response with the email data
     return response()->json([
         'success' => true,
         'email' => $message->email,
         'subject' => 'in re: ' . $message->subject,
         'body' => 'Hello, ' . $message->name . ',' . '<br><br>' . 'Thank you for reaching out to us. <br><br>' .
         $message->reply . '<br><br>' . 

         'Best regards,<br>Mary Anne @ Fusco Artistry' . '<br><br>' .
          'This is a response to your message received on ' . $message->created_at->setTimezone('America/New_York')->format('m-d-y')  . ': ' . '<br>' . $message->body 
          
     ]);
     //Redirect to the messages index page
     return back()->with('success', 'Replied to message successfully');
 }

  
    //Delete Message Data
/* public function destroy(Request $request, Message $message)
{
    $message->delete();

    if ($request->query('stay') === 'messages') {
        return redirect('/admins/messages')->with('message', 'Message deleted successfully');
    }
    if($message->image && Storage::disk('public')->exists($message->image)) {
      Storage::disk('public')->delete($message->image);
  }

    return redirect('admins/messages/')->with('message', 'Message deleted successfully');
} */
//--------------------------------
// Archive begin --------------------------------
public function archive (Message $message) {
  // Create a new archive message instance
  $archive_message = new ArchiveMessage();

  // Set all required fields
  $archive_message->archive_name = $message->name;
  $archive_message->archive_email = $message->email;
  $archive_message->archive_subject = $message->subject;
  $archive_message->archive_body = $message->body;
  $archive_message->archive_upload = $message->image;
  $archive_message->archive_reply = $message->reply;
  $archive_message->original_creation_date = $message->created_at; 
  $archive_message->reply_creation_date = $message->updated_at; 
  $archive_message->created_at = now();
  $archive_message->updated_at = now();
  // if the update_at is the exact same as the created_at date, set the reply date to null - there was no reply
  if( $archive_message->reply_creation_date == $message->created_at){
    $archive_message->reply_creation_date = null;
  } 

  // Save the archive message
  $archive_message->save();

  // Delete the original  message
  $message->delete();

  return redirect('/archive-messages/index')->with('archive_messages $archive_messages', 'success', 'Message archived successfully');
}
//archive end --------------------------------
}
    