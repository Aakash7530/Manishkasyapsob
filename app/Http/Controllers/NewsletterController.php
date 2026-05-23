<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:150',
            'name'  => 'nullable|string|max:100',
        ]);

        $exists = Newsletter::where('email', $request->email)->first();
        if ($exists) {
            return back()->with('info', 'You are already subscribed!');
        }

        Newsletter::create([
            'email'  => $request->email,
            'name'   => $request->name ?? '',
            'status' => 'active',
            'token'  => Str::random(32),
        ]);

        return back()->with('success', 'Successfully subscribed to our newsletter!');
    }
}
