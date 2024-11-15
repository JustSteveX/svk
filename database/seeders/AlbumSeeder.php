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
        $albumNames = ['Highlights', 'Videos'];

        foreach($albumNames as $albumName){
          if(!Album::where('name', $albumName)->first()){
            Album::create([
              'name' => $albumName,
              'archived' => false, // Setze die entsprechenden Werte für andere Felder
            ]);
          }
        }
    }
}
