<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contactList = Contact::orderBy('sort_order', 'asc')->get();

        return view('components.content.contact', compact('contactList'));
    }

    public function store(Request $request): RedirectResponse
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

        $id = Contact::latest('id')->first()->id ?? 0;

        Contact::create(['title' => $request->get('title'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phonenumber' => $request->get('phonenumber'),
            'sort_order' => $id,
        ]);

        return redirect()->back()->with('success', 'Kontakt wurde erfolgreich angelegt.');
    }

    public function update(Request $request): RedirectResponse
    {
        if (! $request->validate([
            'id' => 'required|exists:contacts,id',
            'direction' => 'required|in:up,down',
        ])) {
            return redirect()->back()->with('error', 'Konnte nicht neu sortieren');
        }
        $contact = Contact::find($request->get('id'));

        if ($contact === null) {
            return redirect()->back()->with('error', 'Kontakt konnte nicht im System gefunden werden.');
        }

        $previousContact = null;

        // Bestimmen der Abfrage basierend auf der Richtung
        if ($request->direction === 'up') {
            // Wenn die Richtung 'up' ist, finde den Kontakt mit der niedrigeren sort_order
            $previousContact = Contact::where('sort_order', '<', $contact->sort_order)
                ->orderBy('sort_order', 'desc') // Höchste sort_order, die kleiner ist
                ->first();
        } else {
            // Wenn die Richtung 'down' ist, finde den Kontakt mit der höheren sort_order
            $previousContact = Contact::where('sort_order', '>', $contact->sort_order)
                ->orderBy('sort_order', 'asc') // Niedrigste sort_order, die größer ist
                ->first();
        }

        $tempSortOrder = Contact::max('sort_order') + 1;
        $originalValue = $contact->sort_order;

        $contact->sort_order = $previousContact->sort_order;
        $previousContact->sort_order = $tempSortOrder;

        // Speichere die Änderungen
        $previousContact->save();
        $contact->save();

        // Jetzt setze die sort_order von previousContact wieder auf den ursprünglichen Wert von contact
        // Setze die sort_order von previousContact zurück auf den ursprünglichen Wert von contact
        $previousContact->sort_order = $originalValue;

        // Speichere die Änderungen
        $previousContact->save();

        return redirect()->back()->with('success', 'Kontakte wurden neu sortiert!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $contact = Contact::find($request->get('id'));

        if ($contact === null) {
            return redirect()->back()->with('error', 'Kontakt konnte nicht im System gefunden werden.');
        }

        Contact::destroy($request->get('id'));

        return redirect()->back()->with('success', 'Kontakt wurde erfolgreich gelöscht');
    }
}
