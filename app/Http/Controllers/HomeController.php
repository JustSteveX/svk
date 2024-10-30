<?php

namespace App\Http\Controllers;

use App\Models\Album;

class HomeController extends Controller
{
    public function index()
    {
        // Highlight Album laden
        //$albumItem = Album::where('name', 'highlights')->first();

        //$mediaList = $albumItem?->media;

        return view('components.content.startpage');
    }
}
