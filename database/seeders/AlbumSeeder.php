<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Überprüfen, ob ein Album mit dem Namen 'Highlights' bereits existiert
        $existingAlbum = Album::where('name', 'Highlights')->first();
        if (! $existingAlbum) {
            // Album mit dem Namen 'Highlights' erstellen, wenn es nicht existiert
            Album::create([
                'name' => 'Highlights',
                'archived' => false, // Setze die entsprechenden Werte für andere Felder
            ]);
            Album::create([
                'name' => 'Videos',
                'archived' => false, // Setze die entsprechenden Werte für andere Felder
            ]);
        }
    }
}
