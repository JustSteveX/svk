<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactList = Contact::all(); //Contact::orderBy('created_at', 'asc')->get();

        return view('components.content.contact', compact('contactList'));
    }

    public function store(Request $request)
    {
        if (
            ! $request->validate([
                'title' => ['string', 'required', 'max:255'],
                'firstname' => ['string', 'required'], 'max:255',
                'lastname' => ['string', 'required', 'max:255'],
                'email' => ['nullable', 'email'],
                'phonenumber' => ['nullable', 'string', 'max:255'],
            ])) {
            return redirect()->back()->with('error', 'Kontakt konnte nicht angelegt werden.');
        }

        Contact::create(['title' => $request->get('title'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phonenumber' => $request->get('phonenumber'),
        ]);

        return redirect()->back()->with('success', 'Kontakt wurde erfolgreich angelegt.');
    }

    public function destroy(Request $request)
    {
        $contact = Contact::find($request->get('id'));

        if ($contact === null) {
            return redirect()->back()->with('error', 'Kontakt konnte nicht im System gefunden werden.');
        }

        Contact::destroy($request->get('id'));

        return redirect()->back()->with('success', 'Kontakt wurde erfolgreich gelöscht');
    }
}
