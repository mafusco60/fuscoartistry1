<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
    return view('messages.index');
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