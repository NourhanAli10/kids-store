<?php

namespace App\Http\Controllers\store;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('store.contact');
    }

    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        Contact::create($data);
        Mail::to('nouranonamm@gmail.com')->send(new ContactMail($data));
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
