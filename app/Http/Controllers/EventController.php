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
        $request->validate([
            'eventname' => ['string', 'required'],
            'location' => ['string', 'required'],
            'starts_on' => ['required', 'date_format:d.m.Y'],
            'fblink' => ['nullable', 'url'],
            'gmap-link' => ['nullable', 'url'],
        ]);

        Event::create(['name' => $request->get('eventname'),
            'location' => $request->get('location'),
            'starts_on' => $request->get('starts_on'),
            'gmap_link' => $request->get('fblink'),
            'fb_link' => $request->get('gmap-link'),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

        /**
         * eventname
          location
          starts_on // date
          fblink
          gmap-link
         */
    }
}
