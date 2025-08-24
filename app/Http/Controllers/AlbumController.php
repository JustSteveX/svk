<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Gibt die Gallery View zurück befüllt mit albumList
     */
    public function index()
    {
        $albumList = Album::orderByRaw("name = 'Highlights' desc")
            ->orderBy('created_at', 'desc')
            ->where('archived', false)
            ->get();

        return view('components.content.gallery', compact('albumList'));
    }

    /**
     * Gibt die Gallery View zurück befüllt mit album
     */
    public function show(string $albumName)
    {
        $album = Album::where('name', $albumName)->where('archived', false)->firstOrFail();
        $mediaList = $album->media;

        return view('components.content.gallery', compact('album', 'mediaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'albumname' => ['string', 'required', 'max:255'],
        ]);

        if (Str::upper($request->albumname) === 'HIGHLIGHTS') {
            return redirect()->back()->with('error', 'Der Name Highlights ist reserviert.');
        }

        $album = new Album;
        $album->name = $request->albumname;

        $album->save();

        return redirect()->back()->with('success', 'Album erfolgreich erstellt.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'albumname' => ['string', 'required', 'max:255'],
            'thumbnail_id' => 'nullable|exists:media,id',
            'id' => ['string', 'required', 'exists:albums,id'],
            'hide' => ['boolean', 'nullable']
        ]);

        $hide = $request->has('hide') ? true : false;

        $album = Album::find($request->id);

        $album->update([
            'name' => $request->albumname,
            'thumbnail_id' => $request->thumbnail_id,
            'archived' => $hide
        ]);

        return redirect()->back()->with('success', 'Das Album wurde erfolgreich editiert');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['string', 'required', 'exists:albums,id'],
        ]);

        $album = Album::find($request->id);

        $mediaList = Media::where('album_id', '=', $album->id)->get();
        foreach ($mediaList as $mediaItem) {
            Storage::delete('media/'.$mediaItem->name);
            $mediaItem->delete();
        }

        $album->delete();

        return redirect()->back()->with('success', 'Album erfolgreich gelöscht.');
    }
}
