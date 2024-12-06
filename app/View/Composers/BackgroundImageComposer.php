<?php

namespace App\View\Composers;

use App\Models\Config;
use App\Models\Media;
use Illuminate\View\View;

class BackgroundImageComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Config-Eintrag suchen
        $configBackground = Config::where('key', 'background_image')->first();
        $backgroundImageUrl = null;

        if ($configBackground && $configBackground->value) {
            // Media-Eintrag anhand der ID suchen
            $media = Media::find($configBackground->value);

            // Pfad generieren, falls Media existiert
            $backgroundImageUrl = $media ? asset('storage/media/' . $media->name) : null;
        }

        // Fallback-Bild setzen, falls kein passender Eintrag gefunden wurde
        $backgroundImageUrl = $backgroundImageUrl ?? asset('images/schuetzenhaus.jpg');

        // Daten an die View übergeben
        $view->with('backgroundImageUrl', $backgroundImageUrl);
    }
}
