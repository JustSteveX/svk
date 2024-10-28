<?php

namespace App\Http\Controllers;

use App\Models\Album;
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
            'files.*' => [
                'required',
                'file',
                'max:20480', //
                'mimetypes:image/jpeg,image/png,image/gif,video/mp4,video/x-msvideo,video/quicktime,video/x-ms-wmv,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.presentation',
            ],
            'album' => ['string', 'required'],
        ], [
            // Benutzerdefinierte Fehlermeldungen
            'files.*.max' => 'Die Datei darf nicht größer als 500 MB sein.',
            'files.*.mimetypes' => 'Der Dateityp ist nicht erlaubt.',
            'album.required' => 'Das Albumfeld ist erforderlich.',
        ]);

        foreach ($request->file('files') as $file) {
            $timestamp = time();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = strtolower($file->getClientOriginalExtension());

            $fileName = $timestamp.'_'.$originalName.'.'.$extension;

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

        return redirect()->back()->with('success', 'Datei erfolgreich hochgeladen.');
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

    /**
     * Übergangslösung bis große Dateien stückchenweise hochgeladen werden können
     * ! WICHTIG dies lädt NUR Videos ins System
     * TODO Sollte ebenfalls den Service für Dateiendungen nutzen
     */
    public function synchronize(Request $request)
    {
        // Alle Video-Dateien aus dem Verzeichnis abrufen
        $videoFiles = Storage::files('ftplink');

        // Das Album mit dem Namen 'Videos' abrufen
        $album = Album::firstWhere('name', 'Videos');

        // Wenn das Album nicht gefunden wird, gib eine Fehlermeldung zurück
        if (! $album) {
            return redirect()->back()->with('error', 'Album "Videos" nicht gefunden.');
        }

        $albumId = $album->id;

        // Alle bestehenden Einträge in der Datenbank abfragen und in ein Set umwandeln
        $existingFiles = Media::select('name', 'mime_type')->get();
        $existingFilesSet = [];

        foreach ($existingFiles as $file) {
            $existingFilesSet["{$file->name}|{$file->mime_type}"] = true; // Kombiniere Name und MIME-Typ
        }

        $newMediaEntries = []; // Array für neue Einträge vorbereiten

        foreach ($videoFiles as $file) {
            $filename = basename($file); // Dateiname ohne Pfad
            $mimeType = Storage::mimeType($file); // MIME-Typ der Datei abrufen

            // Prüfen, ob die Datei bereits existiert
            if (isset($existingFilesSet["{$filename}|{$mimeType}"])) {
                continue; // Datei ignorieren, wenn sie bereits existiert
            }

            // Neue Media-Daten für die Datenbank vorbereiten
            $newMediaEntries[] = [
                'name' => $filename,
                'mime_type' => $mimeType,
                'album_id' => $albumId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Batch-Insert für neue Einträge, falls vorhanden
        if (! empty($newMediaEntries)) {
            Media::insert($newMediaEntries);
        }

        return redirect()->back()->with('success', 'Synchronisation erfolgreich');
    }
}
