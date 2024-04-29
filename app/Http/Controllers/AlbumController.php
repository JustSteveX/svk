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
        $albumList = Album::all();

        return view('components.content.gallery', compact('albumList'));
    }

    /**
     * Gibt die Gallery View zurück befüllt mit album
     */
    public function show(string $albumName)
    {
        $album = Album::where('name', $albumName)->firstOrFail();
        $mediaList = $album->media;

        return view('components.content.gallery', compact('album', 'mediaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required', 'max:255'],
        ]);

        if (Str::upper($request->name) === 'HIGHLIGHTS') {
            return redirect()->back()->with('error', 'Der Name Highlights ist reserviert.');
        }

        $album = new Album;
        $album->name = $request->name;

        $album->save();

        return redirect()->back()->with('success', 'Album erfolgreich erstellt.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'id' => ['string', 'required'],
        ]);

        $album = Album::find($request->id);

        if (Str::upper($album->name) === 'HIGHLIGHTS') {
            return redirect()->back()->with('error', 'Dieses Album ist nicht editierbar.');
        }

        $album->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Das Album wurd erfolgreich editiert');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['string', 'required'],
        ]);

        $album = Album::find($request->id);

        if (Str::upper($album->name) === 'HIGHLIGHTS') {
            return redirect()->back()->with('error', 'Dieses Album ist nicht löschbar.');
        }

        $mediaList = Media::where('album_id', '=', $album->id)->get();
        foreach ($mediaList as $mediaItem) {
            Storage::delete('media/'.$mediaItem->name);
            $mediaItem->delete();
        }

        $album->delete();

        return redirect()->back()->with('success', 'Album erfolgreich gelöscht.');
    }
}
