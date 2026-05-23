<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $key = 'contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with('error', 'Too many submissions. Please try again later.');
        }
        RateLimiter::hit($key, 3600);

        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        $contact = Contact::create([
            ...$validated,
            'status'     => 'unread',
            'ip_address' => $request->ip(),
        ]);

        try {
            Mail::to(config('app.admin_email', 'contactmanishkasyap@gmail.com'))
                ->queue(new ContactSubmitted($contact));
        } catch (\Exception $e) {
            \Log::error('Contact mail failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you! Your message has been sent. We will respond shortly.');
    }
}
