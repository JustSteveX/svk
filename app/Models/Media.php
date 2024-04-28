<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mime_type', 'album_id', 'caption', 'created_at'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function url()
    {
        return 'storage/media/'.$this->name;
    }

    public function isImage(): bool
    {
        $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg']; // Liste der Bild-Dateiendungen

        // Überprüfe den Dateinamen
        $extension = pathinfo($this->name, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $imageExtensions)) {
            return true;
        }

        // Überprüfe den MIME-Typ
        $imageMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/svg+xml']; // Liste der Bild-MIME-Typen
        if (in_array($this->mime_type, $imageMimeTypes)) {
            return true;
        }

        return false;
    }

    public function shortenedName(): string
    {
        $fileParts = explode('_', $this->name, 2); // Aufteilen des Dateinamens nach dem ersten Unterstrich

        return pathinfo($fileParts[1], PATHINFO_FILENAME); // Entfernen der Dateierweiterung
    }
}
