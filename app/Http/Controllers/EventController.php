<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Gibt alle Events mit starts_on dem Datum auf heute oder in der Zukunft gesetzt
        // und nur wenn ends_on das Datum auf heute oder in der Zukunft gesetzt ist, kann das starts_on in der Vergangenheit liegen
        $eventList = Event::where(function ($query) {
            $query->where('starts_on', '>=', Carbon::today())
                ->orWhere(function ($query) {
                    $query->where('starts_on', '<=', Carbon::today())
                        ->whereNotNull('ends_on')
                        ->where('ends_on', '>=', Carbon::today());
                });
        })
            ->orderBy('starts_on', 'desc')
            ->get();

        return view('components.content.event', compact('eventList'));
    }

    /**
     * Create a new event
     */
    public function store(Request $request)
    {
        $request->validate([
            'eventname' => ['string', 'required'],
            'location' => ['string', 'required'],
            'starts_on' => [
                'required',               // Pflichtfeld
                'date',                   // Muss ein Datum sein
            ],
            'ends_on' => [
                'nullable',               // Optionales Feld
                'date',                   // Muss ein Datum sein, falls gesetzt
                'after_or_equal:starts_on',
            ],
            'fblink' => ['nullable', 'url'],
            'gmap-link' => ['nullable', 'url'],
        ], [
            // Benutzerdefinierte Fehlermeldungen
            'starts_on.required' => 'Das Startdatum ist erforderlich.',
            'starts_on.date' => 'Das Startdatum muss ein gültiges Datum sein.',
            'ends_on.after_or_equal' => 'Das Startdatum muss vor oder gleich dem Enddatum sein.',
            'ends_on.date' => 'Das Enddatum muss ein gültiges Datum sein.',
        ]);

        Event::create(['name' => $request->get('eventname'),
            'location' => $request->get('location'),
            'starts_on' => $request->get('starts_on'),
            'ends_on' => $request->get('ends_on'),
            'fb_link' => $request->get('fblink'),
            'gmap_link' => $request->get('gmap-link'),
        ]);

        return redirect()->back()->with('success', 'Termin wurde erfolgreich angelegt.');
    }

    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|string|exists:events,id']);

        return redirect()->back()->with('success', 'Termin wurde erfolgreich entfernt');
    }
}
