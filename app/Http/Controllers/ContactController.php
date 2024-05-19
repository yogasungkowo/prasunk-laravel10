<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'thoughts' => 'nullable|string',
        ]);

        // Ambil data dari form
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'thoughts' => $request->thoughts,
        ];
        
        try {
            // Kirim email
            Mail::to('prayogasungkowo12@gmail.com')->send(new ContactMail($data));
            
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Thank you for contacting us!');
        } catch (\Exception $e) {
            // Log error
            Log::error('Email sending failed: ' . $e->getMessage());
            
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again later.');
        }
    }
}

