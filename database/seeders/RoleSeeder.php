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
        $roles = ['superadmin', 'admin', 'user'];
        DB::table('roles')->insert([
            ['rolename' => $roles[0]],
            ['rolename' => $roles[1]],
            ['rolename' => $roles[2]],
        ],
        );
        error_log('Die Rollen wurden angelegt: '.implode(', ', $roles));
    }
}
