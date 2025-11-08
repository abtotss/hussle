<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // see Mailable section below

class ContactController extends Controller
{
    public function show()
    {
        return view('contact'); // assumes view path resources/views/contact.blade.php
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // send the email (uses ContactFormMail mailable below)
        Mail::to(config('mail.from.address', 'support@hussletools.com'))
            ->send(new ContactFormMail($data));

        return redirect()->route('contact.show')->with('success', 'Thanks — your message was sent. We will reply shortly.');
    }
}
