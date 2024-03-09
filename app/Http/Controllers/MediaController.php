<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => ['required', 'file', 'mimes:jpeg,png,pdf,mp4,gif', 'max:20480'], // Anpassen der Validierungsregeln je nach Bedarf
            'album' => ['string', 'required'],
        ]);

        foreach ($request->file('files') as $file) {
            $fileName = time().'_'.$file->getClientOriginalName();

            // Datei im Storage speichern
            Storage::disk('public')->put('media/'.$fileName, file_get_contents($file));

            // Datensatz für Media erzeugen
            $media = new Media;
            $media->name = $fileName;
            $media->mime_type = $file->getMimeType();
            $media->album_id = $request->album;
            $media->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string'],
        ]);

        $mediaItem = Media::find($request->id);
        if (isset($mediaItem)) {
            Media::destroy($mediaItem->id);
            Storage::delete('media/'.$mediaItem->name);

            return redirect()->back()->with('success', 'File successfully deleted.');

        }

        return redirect()->back()->with('error', 'Datei wurde nicht gefunden');
    }
}
