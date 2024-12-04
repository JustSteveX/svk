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
use App\Models\Config;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $albumList = Album::orderBy('name', 'asc')->get();
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
        $configList = Config::all();

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
            'configList'
        ));
    }

    public function setConfig(Request $request){
      $request->validate([
        'startpage_album' => 'nullable|exists:albums,id',
        'startpage_blogpost' => 'nullable|exists:blogposts,id',
        'background_image' => 'nullable|exists:media,id'
      ]);

      if(isset($request->startpage_album)){
        Config::updateOrInsert(
          ['key' => 'startpage_album'],
          ['value' => $request->startpage_album]
        );
      } else {
        Config::where('key', 'startpage_album')->delete();
      }

      if(isset($request->startpage_blogpost)){
        Config::updateOrInsert(
          ['key' => 'startpage_blogpost'],
          ['value' => $request->startpage_blogpost]
        );
      } else {
        Config::where('key', 'startpage_blogpost')->delete();
      }

      if(isset($request->background_image)){
        Config::updateOrInsert(
          ['key' => 'background_image'],
          ['value' => $request->background_image]
        );
      } else {
        Config::where('key', 'background_image')->delete();
      }

      return redirect()->back()->with('success', 'Einstellungen wurden übernommen');
    }
}
