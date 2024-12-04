<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Config;
use App\Models\Blogpost;

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
}
