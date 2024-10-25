<?php

namespace App\Http\Controllers;


use App\Models\ArchiveMessage;
use App\Models\Message;
use App\Models\User;
use App\Models\Artwork;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ArchiveMessageController extends Controller
{
   public function __construct()
  {
      // Apply the 'auth' middleware to all methods
      // $this->middleware('auth:admin');
  } 
  
   
    //Show all archived messages
    public function index(): View
    {
      $archive_messages = ArchiveMessage::latest()->with('user','artwork')->get();
        return view ('archive-messages.index', compact('archive_messages'));
   
    
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
    $formFields = $request->validate([
  
        'archive_name' => 'required',
        'archive_email' => 'required',
        'archive_subject' => 'required',
        'archive_body' => 'required',
        'archive_upload' => 'nullable',
        'archive_reply' => 'nullable',
        'archive_sender_id' => 'nullable',
        'archive_artwork_id' => 'nullable',
        'original_creation_date' => 'required',
        'reply_creation_date' => 'nullable'
      ]);
  
      if($request->hasFile('archive_upload')){
        $upload = $request->file('archive_upload');
        $filename = time() . '_' . $upload->getClientOriginalName();
        $formFields['archive_upload'] = $upload->storeAs('uploads', $filename, 'public');
      }
   
      ArchiveMessage::create($formFields);
    
        return redirect('/archive-messages')->with('success', 'Message sent successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(ArchiveMessage $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArchiveMessage $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArchiveMessage $archive_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //Delete Archive Data
public function destroy(Request $request, ArchiveMessage $archive_message)
{
    $archive_message->delete();

    if ($request->query('stay') === 'archive_message') {
        return redirect('/archive-messages')->with('success', 'Message deleted successfully');
    }
    if ($archive_message->archive_upload && Storage::disk('public')->exists($archive_message->archive_upload)) {
      Storage::disk('public')->delete($archive_message->archive_upload);
  }
    return redirect('/archive-messages')->with('success', 'Message and file deleted successfully');
}

public function restore(ArchiveMessage $archive_message) {
    // Create a new restored message instance
    $message = new message();
  
    // Set all required fields
    $message->name = $archive_message->archive_name;
    $message->email = $archive_message->archive_email;
    $message->subject = $archive_message->archive_subject;
    $message->body = $archive_message->archive_body;
    $message->reply = $archive_message->archive_reply;
    $message->image = $archive_message->archive_upload;
    if ($archive_message->archive_sender_id)
    $message->sender_id = $archive_message->archive_sender_id;
    if ($archive_message->archive_artwork_id)
    $message->artwork_id = $archive_message->archive_artwork_id;
    $message->created_at = $archive_message->original_creation_date;
    $message->updated_at = $archive_message->reply_creation_date;
    $message->created_at = now();
    $message->updated_at = now();
    
  
    // Restore the messge
    $message->save();
  
    // Delete the archived message
    $archive_message->delete();
  
    return redirect('/messages')->with('message', 'Message restored successfully');
  }
   
}

