<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [];
        DB::table('roles')->insert([
            ['rolename' => 'superadmin', 'permissions' => 4095],
        ],
        );
        error_log('Die Rollen wurden angelegt: '.implode(', ', $roles));
    }
}
