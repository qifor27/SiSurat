<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'wakil_rektor']);
        Role::firstOrCreate(['name' => 'rektor']);
        Role::firstOrCreate(['name' => 'bagian_terkait']);
    }
}
