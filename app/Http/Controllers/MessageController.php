<?php

namespace App\Http\Controllers;

use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {   
        $messages = Message::latest()->paginate(9);
        
        return view('messages.index')->with('messages', $messages);

    }
    public function create()
    {
        return view('messages.create');
    }
    public function store(Request $request)
    {

    return redirect()->route('messages.index')->with('success', 'Message sent successfully');
}

}