<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Carbon\Carbon;
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
            // Erlaubte FileTypen: jp(e)g, png, gif, videos (mp4, avi, mov, wmv), pdf, docx, xlsx, pptx, odt, ods, odp
            'files.*' => [
                'required',
                'file',
                'max:20480', // Maximale Dateigröße 20 MB
                'mimetypes:image/jpeg,image/png,image/gif,video/mp4,video/x-msvideo,video/quicktime,video/x-ms-wmv,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.presentation',
            ],
            'album' => ['string', 'required'],
        ]);

        foreach ($request->file('files') as $file) {
            $timestamp = time();
            $fileName = $timestamp.'_'.$file->getClientOriginalName();

            // Datei im Storage speichern
            Storage::disk('public')->put('media/'.$fileName, file_get_contents($file));

            // Datensatz für Media erzeugen
            // $media = new Media;
            // $media->name = $fileName;
            // $media->mime_type = $file->getMimeType();
            // $media->album_id = $request->album;
            // $media->save();

            Media::create([
                'name' => $fileName,
                'mime_type' => $file->getMimeType(),
                'album_id' => $request->album,
                'created_at' => Carbon::createFromTimestamp($timestamp),
            ]);
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
