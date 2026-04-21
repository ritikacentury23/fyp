<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form page
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store contact message in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'Please enter your name',
            'name.string' => 'Name must be text',
            'name.max' => 'Name cannot exceed 255 characters',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email cannot exceed 255 characters',
            'message.required' => 'Please enter your message',
            'message.string' => 'Message must be text',
            'message.min' => 'Message must be at least 10 characters',
            'message.max' => 'Message cannot exceed 5000 characters',
        ]);

        try {
            // Create contact record
            $contact = Contact::create($validated);

            if ($contact) {
                return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
            } else {
                return redirect()->back()->with('error', 'Error sending message. Please try again later.')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.')->withInput();
        }
    }

    /**
     * Display all contacts in admin panel
     */
    public function adminIndex()
    {
        $contacts = Contact::latest()->paginate(15);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Display a single contact message
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read when viewing
        if ($contact->status === 'unread') {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Mark contact as replied
     */
    public function markAsReplied($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsReplied();

        return redirect()->back()->with('success', 'Message marked as replied');
    }

    /**
     * Delete a contact message
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully');
    }

    /**
     * Delete multiple contacts
     */
    public function destroyBulk(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Please select at least one message');
        }

        Contact::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids) . ' message(s) deleted successfully');
    }
}