<?php
namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Message;
use App\Models\ArchiveMessage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    // Show the form to create a new message from the home page
    public function create($artwork_id): View
    {
        $artwork = Artwork::findOrFail($artwork_id);
        return view('messages.create', compact('artwork'));
    }

    public function createWOArtwork(): View
    {
        return view('messages.create');
    }

    // Save the message to the database
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
        $formFields['artwork_title'] = $request->input('artwork_title');

        // Save the message to the database
        // Message::create($formFields);
        $message = new Message($formFields);
        $message->save();


        return redirect()->route('home')->with('success', 'Message sent successfully!');
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
        $message = Message::findOrFail($message->id);
        $sender_id = $message->sender_id;
        return view('messages.edit', compact('message', 'sender_id'));
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
     $message->updated_at = now();
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

 public function destroy(Request $request, Message $message)
{
    $message->delete();

    if ($request->query('stay') === 'message') {
        return redirect('/messages')->with('error', 'Message not deleted');
    }
    if ($message->image && Storage::disk('public')->exists($message->image)) {
      Storage::disk('public')->delete($message->image);
  }
    return redirect('/messages')->with('success', 'Message and file deleted successfully');
}
  
    
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
  if ($message->reply)
    $archive_message->archive_reply = $message->reply;
  if ($message->sender_id)
    $archive_message->archive_sender_id = $message->sender_id;
    if ($message->artwork_title)
    $archive_message->archive_artwork_title = $message->artwork_title;
  $archive_message->original_creation_date = $message->created_at; 
  $archive_message->reply_creation_date = $message->updated_at; 
  // if the update_at is the exact same as the created_at date, set the reply date to null - there was no reply
//   if( $archive_message->reply_creation_date == $message->updated_at){
//     $archive_message->reply_creation_date = null;
//  } 

  // Save the archive message
  $archive_message->save();

  // Delete the original  message
  $message->delete();

  return redirect('/messages')->with('archive_messages $archive_messages', 'success', 'Message archived successfully');
}
//archive end --------------------------------


public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));

        $query = Message::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(body) like ?', ['%' . $keywords . '%'])
                ->orWhereRaw('LOWER(name) like ?', ['%' . $keywords . '%'])
                ->orWhereRaw('LOWER(subject) like ?', ['%' . $keywords . '%'])
                 ->orWhereRaw('LOWER(email) like ?', ['%' . $keywords . '%'])
                 ->orWhereRaw('LOWER(reply) like ?', ['%' . $keywords . '%'])
                 ->orWhereRaw('LOWER(image) like ?', ['%' . $keywords . '%'])

                 ->orWhereHas('artwork', function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%']);
                })
                ->orWhereHas('user', function ($q) use ($keywords) {
                $q->whereRaw('LOWER(firstname) like ?', ['%' . $keywords . '%']);
                $q->whereRaw('LOWER(lastname) like ?', ['%' . $keywords . '%']);

                });

          });
        }

        $messages = $query->paginate(12);

        return view('messages.index', compact ('messages'));
    }
}
    