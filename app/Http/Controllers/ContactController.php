<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'thoughts' => 'required|string',
        ]);

        try {
            $contact = $validated;

            // Kirim email
            Mail::to('prayogasungkowo1@gmail.com')->send(new ContactMail($contact));

            // Set session flash data for success
            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            
            // Set session flash data for failure
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }
    }
}
