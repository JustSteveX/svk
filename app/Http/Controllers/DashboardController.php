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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $albumList = Album::where('name', '!=', 'Videos')->orderBy('name', 'asc')->get();
        $mediaList = Media::all();
        $blogpostList = Blogpost::orderBy('created_at', 'desc')->get();
        $eventList = Event::orderBy('starts_on', 'desc')->get();
        $subpageList = Subpage::all();
        $subscriberList = Subscriber::orderBy('email_verified_at', 'desc')
                                    ->orderBy('created_at', 'desc')
                                    ->orderBy('email', 'asc')
                                    ->get();
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
            'contactList',
        ));
    }
}
