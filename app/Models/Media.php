<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BladeUI\Icons\Svg;

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

    public function getFileName(): string{
      return pathinfo($this->name, PATHINFO_FILENAME);
    }

    /**
     * $convertHtmlQuotes gibt an ob die HTML doubleQuotes in single quotes umgewandelt werden sollen
     */
    public function getIcon(bool $convertHtmlQuotes = false): string{
      $icon = svg('bi-file-earmark-fill');
      switch (true) {
        case str_starts_with($this->mime_type, 'image/'):
            $icon = svg('bi-image-fill');
            break;
        case str_starts_with($this->mime_type, 'video/'):
            $icon = svg('bi-play-fill');
            break;
        case $this->mime_type === 'application/pdf':
            $icon = svg('bi-file-earmark-pdf-fill');
            break;
        case $this->mime_type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            $icon = svg('bi-file-earmark-word-fill');
            break;
        case $this->mime_type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            $icon = svg('bi-file-earmark-spreadsheet-fill');
            break;
        case $this->mime_type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
            $icon = svg('bi-file-earmark-slides-fill');
            break;
        case str_starts_with($this->mime_type, 'audio/'):
            $icon = svg('bi-music-note-beamed');
            break;
        case str_starts_with($this->mime_type, 'text/'):
            $icon = svg('bi-file-earmark-text-fill');
            break;
      }
      $svg = (string) $icon->contents();
      $cssClass = 'w-20 h-20 text-primary';

      $svg = preg_replace('/<svg/', "<svg class=\"$cssClass\"", $svg, 1);
      if($convertHtmlQuotes) $svg = str_replace('"', '\'', $svg);
      return $svg;
  }
}
