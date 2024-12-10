<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Config;
use App\Models\Blogpost;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $mediaList = null;
        $blogpost = null;
        $album = null;

        $startpageAlbum = Config::where('key', 'startpage_album')->value('value');
        if ($startpageAlbum) {
            $album = Album::with('media')->find($startpageAlbum);
            $mediaList = $album?->media;
        }

        if (!$mediaList) {
            $startpageBlogpost = Config::where('key', 'startpage_blogpost')->value('value');
            if ($startpageBlogpost) {
                $blogpost = Blogpost::find($startpageBlogpost);
            }
        }

        return view('components.content.startpage', compact('album','mediaList', 'blogpost'));
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
