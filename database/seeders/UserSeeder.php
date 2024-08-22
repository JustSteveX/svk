<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = Str::random(10).'@example.com';
        $password = Str::random(10);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => 1,
        ]);
        error_log('Benutzer wurde angelegt: '.$email.' / '.$password, 4);
    }
}
