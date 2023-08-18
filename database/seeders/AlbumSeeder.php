<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // TODO anpassen damit die Album Default Werte auch gesetzt werden (muss übers model funktionieren)
        DB::table('albums')->insert([
          'name' => 'Highlights',
          'show_in_gallery' => false
        ]);
    }
}
