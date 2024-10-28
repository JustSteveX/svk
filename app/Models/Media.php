<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mime_type', 'album_id', 'caption', 'created_at'];

    private static $IMAGE_EXTENSIONS = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg'];

    private static $IMAGE_MIME_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/svg+xml'];

    private static $VIDEO_MIME_TYPES = [
        'video/mp4',
        'video/x-msvideo',
        'video/quicktime',
        'video/x-ms-wmv',
        'video/x-flv',
        'video/webm',
        'video/x-matroska',
        'video/3gpp',
        'video/3gpp2',
        'video/mpeg',
        'video/x-m4v',
    ];

    private static $VIDEO_EXTENSIONS = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp', 'mpeg', 'm4v'];

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
        return Media::checkFile($this->name, $this->mime_type, Media::$IMAGE_EXTENSIONS, Media::$IMAGE_MIME_TYPES);
    }

    public function isVideo(): bool
    {
        return Media::checkFile($this->name, $this->mime_type, Media::$VIDEO_EXTENSIONS, Media::$VIDEO_MIME_TYPES);
    }

    public function shortenedName($withExtension = false): string
    {
        if ($this->isVideo()) {
            return $this->name;
        }

        $fileParts = explode('_', $this->name, 2); // Aufteilen des Dateinamens nach dem ersten Unterstrich

        return $withExtension === true ? $fileParts[1] : pathinfo($fileParts[1], PATHINFO_FILENAME); // Entfernen der Dateierweiterung
    }

    // TODO auslagern in einen Service
    private static function checkFile(string $name, string $mime_type, array $extensions, array $mime_types): bool
    {
        // Überprüfe den Dateinamen
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $extensions)) {
            return true;
        }
        if (in_array($mime_type, $mime_types)) {
            return true;
        }

        return false;
    }
}
