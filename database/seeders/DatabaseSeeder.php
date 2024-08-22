<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $files_arr = scandir(dirname(__FILE__)); //store filenames into $files_array
        $blacklist_arr = ['AlbumSeeder.php'];
        foreach ($files_arr as $key => $file) {
            echo $file.$blacklist_arr[0];
            if (in_array($file, $blacklist_arr) || $file !== 'DatabaseSeeder.php' && $file[0] !== '.') {
                $this->call(explode('.', $file)[0]);
            }
        }
    }
}
