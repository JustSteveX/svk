<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index(): View
    {
        $subpage = Subpage::where('parent_id', '=', null)->get()->first();

        return view('components.content.club', compact('subpage'));
    }

    public function show(string $path): View
    {
        $subpageTitles = array_map(function ($step) {
            return urldecode(strtolower($step));
        }, explode('/', $path));

        $subpageList = Subpage::all();
        $subpage = null;
        foreach ($subpageList as $subpageItem) {
            if (in_array(strtolower($subpageItem->title), $subpageTitles)) {
                $subpage = $subpageItem;
            }
        }

        //$album = Album::where('name', $albumName)->firstOrFail();
        //$mediaList = $album->media;

        //return view('components.content.gallery', compact('album', 'mediaList'));

        return view('components.content.club', compact('subpage'));
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->validate([
            'title' => ['string', 'required'],
            'content' => ['string', 'required'],
            'parent_id' => ['nullable', 'exists:subpages,id'],
        ])) {
            return redirect()->route('dashboard')->with('error', 'Fehlgeschlagen');
        }

        $subpage = Subpage::whereNull('parent_id')->first();

        if ($subpage) {
            $subpage->title = $request->title;
            $subpage->content = $request->content;
            $subpage->save();
        } else {
            Subpage::create(['title' => $request->title, 'content' => $request->content, 'parent_id' => $request->parent_id]);
        }
        // Subpage::updateOrCreate(['parent_id' => null], ['title' => $request->title, 'content' => $request->content]);

        return redirect()->route('dashboard')->with('success', 'Die Seite wurde erfolgreich angelegt');
    }
}
