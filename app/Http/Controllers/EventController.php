<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $eventList = Event::where('starts_on', '>=', Carbon::today())->orderBy('starts_on', 'desc')->get();

        return view('components.content.event', compact('eventList'));
    }

    /**
     * Create a new event
     */
    public function store(Request $request)
    {
        if (
            ! $request->validate([
                'eventname' => ['string', 'required'],
                'location' => ['string', 'required'],
                'starts_on' => ['required', 'date_format:d.m.Y'],
                'fblink' => ['nullable', 'url'],
                'gmap-link' => ['nullable', 'url'],
            ])) {
            return redirect()->back()->with('error', 'Termin konnte nicht angelegt werden.');
        }

        Event::create(['name' => $request->get('eventname'),
            'location' => $request->get('location'),
            'starts_on' => $request->get('starts_on'),
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
