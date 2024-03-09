<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Blogpost;
use App\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        $albumList = Album::all();
        $mediaList = Media::all();
        $blogpostList = Blogpost::all();

        return view('dashboard', compact('albumList', 'mediaList', 'blogpostList'));
    }
}
