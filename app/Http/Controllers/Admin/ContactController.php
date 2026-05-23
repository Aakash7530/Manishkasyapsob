<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Mail\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $replyHistory = $contact->reply_history ?? [];
        $replyHistory[] = [
            'message' => $request->reply_message,
            'replied_at' => now()->toDateTimeString(),
        ];

        try {
            Mail::to($contact->email)->send(new ContactReply($contact, $request->reply_message));
            $contact->update([
                'admin_reply' => $request->reply_message, // Keep latest reply for quick reference
                'replied_at'  => now(),
                'status'      => 'replied',
                'reply_history' => $replyHistory,
                'delivery_status' => 'delivered',
            ]);
            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Contact reply mail failed: ' . $e->getMessage());
            $contact->update([
                'admin_reply' => $request->reply_message,
                'replied_at'  => now(),
                'status'      => 'replied',
                'reply_history' => $replyHistory,
                'delivery_status' => 'failed',
            ]);
            return back()->with('error', 'Reply saved, but failed to send email. Check logs.');
        }
    }

    public function destroy(string $id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted.');
    }
}
