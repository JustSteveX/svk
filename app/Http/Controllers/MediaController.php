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

            $fileName = $this->createMediaName($file->getClientOriginalName(), $timestamp);

            // Datei im Storage speichern
            Storage::disk('public')->put('media/'.$fileName, file_get_contents($file));

            Media::create([
                'name' => $fileName,
                'mime_type' => $file->getMimeType(),
                'album_id' => $request->album,
                'created_at' => Carbon::createFromTimestamp($timestamp),
                'updated_at' => Carbon::createFromTimestamp($timestamp)
            ]);
        }

        return redirect()->back()->with('success', 'Datei(en) erfolgreich hochgeladen.');
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
    public function move(Request $request, Media $media)
    {
        // Anfrage validieren
        $validated = $request->validate([
            'medias' => 'required|array|min:1',
            'medias.*' => 'integer|exists:media,id', // Überprüfen, ob jede Medien-ID in der media-Tabelle existiert
            'album' => 'required|integer|exists:albums,id', // Überprüfen, ob die Album-ID in der albums-Tabelle existiert
        ]);

        // Album- und Medien-IDs aus den validierten Daten abrufen
        $albumId = $validated['album'];
        $mediaIds = $validated['medias'];

        // Medien-Einträge aktualisieren
        $updated = Media::whereIn('id', $mediaIds)->update(['album_id' => $albumId]);

        if ($updated) {
            return redirect()->back()->with('success', 'Medien erfolgreich verschoben');
        }

        return redirect()->back()->with('error', 'Fehler beim Verschieben der Medien');
    }

    public function update(Request $request){
      $request->validate([
        'id' => 'required|exists:media,id',
        'imagename' => 'required|string|max:255',
        'imagecaption' => 'nullable|string|max:255'
      ]);

      $media = Media::find($request->id);
      if(!$media){
        return redirect()->back()-with('error', 'Media konnte nicht geändert werden.');
      }

      $originalFileName = $media->name;
      $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
      $newFileName = $this->createMediaName($request->imagename.'.'.$fileExtension, $media->created_at->timestamp);

      $path = 'media/';

      if(Storage::exists($path.$newFileName)){
        return redirect()->back()->with('error', 'Dieser Dateiname ist bereits vergeben');
      }

      Storage::move($path.$media->name, $path.$newFileName);

      $media->name = $newFileName;
      $media->caption = $request->caption;
      $media->save();

      return redirect()->back()->with('success', 'Media erfolgreich umbenannt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Anfrage validieren
        $validated = $request->validate([
            'medias' => 'required|array|min:1',
            'medias.*' => 'integer|exists:media,id', // Überprüfen, ob jede Medien-ID in der media-Tabelle existiert
        ]);

        // Medien-IDs aus den validierten Daten abrufen
        $mediaIds = $validated['medias'];

        // Medien-Einträge abrufen
        $mediaItems = Media::whereIn('id', $mediaIds)->get();

        // Dateien aus dem Storage löschen
        foreach ($mediaItems as $mediaItem) {
            Storage::delete('media/'.$mediaItem->name);
        }

        // Medien-Einträge löschen
        $deleted = Media::whereIn('id', $mediaIds)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Medien erfolgreich gelöscht');
        }

        return redirect()->back()->with('error', 'Fehler beim Löschen der Medien');
    }

    /**
     * Übergangslösung bis große Dateien stückchenweise hochgeladen werden können
     * ! WICHTIG dies lädt NUR Videos ins System
     * TODO Sollte ebenfalls den Service für Dateiendungen nutzen
     */
    public function synchronize()
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

        foreach ($videoFiles as $filePath) {
          $timestamp = time();
          $file = Storage::get($filePath);
          $fileName = $this->createMediaName($filePath, $timestamp);
          $mimeType = Storage::mimeType($filePath); // MIME-Typ der Datei abrufen

          // Prüfen, ob die Datei bereits existiert
          if (isset($existingFilesSet["{$fileName}|{$mimeType}"])) {
              continue; // Datei ignorieren, wenn sie bereits existiert
          }

          if(Storage::disk('public')->put('media/'.$fileName, $file)){
            Storage::disk('public')->delete($filePath);
          }

          // Neue Media-Daten für die Datenbank vorbereiten
          $newMediaEntries[] = [
              'name' => $fileName,
              'mime_type' => $mimeType,
              'album_id' => $albumId,
              'created_at' => Carbon::createFromTimestamp($timestamp),
              'updated_at' => Carbon::createFromTimestamp($timestamp)
          ];
        }

        // Batch-Insert für neue Einträge, falls vorhanden
        if (! empty($newMediaEntries)) {
            Media::insert($newMediaEntries);
        }

        return redirect()->back()->with('success', 'Synchronisation erfolgreich');
    }

    private function createMediaName(string $filePath, int $timestamp = null): string{
      $timestamp = $timestamp ?? time();

      // Originalname des Files extrahieren
      $originalName = pathinfo($filePath, PATHINFO_FILENAME);

      // Ersetze ungültige Zeichen für Windows und Linux (z.B. /, \0, \, :, *, ?, ", <, >, |)
      // Alle Zeichen außer alphanumerischen, Umlaute und Sonderzeichen wie "-" und "_"
      $originalName = preg_replace('/[^a-zA-Z0-9äöüÄÖÜß_\- ]/', '_', $originalName);

      // Konvertiere die Erweiterung in Kleinbuchstaben
      $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

      // Kürze den Dateinamen auf eine sichere Länge (z. B. max. 100 Zeichen)
      $originalName = substr($originalName, 0, 100);

      // Generiere den neuen Dateinamen
      return sprintf('%s_%s.%s', $timestamp, $originalName, $extension);
    }
}
