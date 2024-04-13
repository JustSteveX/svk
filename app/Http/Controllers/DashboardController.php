<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Blogpost;
use App\Models\Event;
use App\Models\Media;
use App\Models\Subpage;

class DashboardController extends Controller
{
    public function index()
    {
        $albumList = Album::all();
        $mediaList = Media::all();
        $blogpostList = Blogpost::orderBy('created_at', 'desc')->get();
        $eventList = Event::orderBy('starts_on', 'desc')->get();
        $subpageList = Subpage::all();

        return view('dashboard', compact('albumList', 'mediaList', 'blogpostList', 'eventList', 'subpageList'));
    }
}
