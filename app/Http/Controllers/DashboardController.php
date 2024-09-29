<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Blogpost;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Invitation;
use App\Models\Media;
use App\Models\Role;
use App\Models\Subpage;
use App\Models\Subscriber;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $albumList = Album::all();
        $mediaList = Media::all();
        $blogpostList = Blogpost::orderBy('created_at', 'desc')->get();
        $eventList = Event::orderBy('starts_on', 'desc')->get();
        $subpageList = Subpage::all();
        $subscriberList = Subscriber::all();
        $roleList = Role::all();
        $invitationList = Invitation::all();
        $userList = User::all();
        $contactList = Contact::orderBy('sort_order', 'asc')->get();

        return view('dashboard', compact(
            'albumList',
            'mediaList',
            'blogpostList',
            'eventList',
            'subpageList',
            'subscriberList',
            'roleList',
            'invitationList',
            'userList',
            'contactList'
        ));
    }
}
