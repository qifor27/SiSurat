<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@alifah.ac.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // 2. Wakil Rektor
        $warek = User::updateOrCreate(
            ['email' => 'warek@alifah.ac.id'],
            [
                'name' => 'Wakil Rektor',
                'password' => Hash::make('password'),
            ]
        );
        $warek->assignRole('wakil_rektor');

        // 3. Rektor
        $rektor = User::updateOrCreate(
            ['email' => 'rektor@alifah.ac.id'],
            [
                'name' => 'Rektor',
                'password' => Hash::make('password'),
            ]
        );
        $rektor->assignRole('rektor');

        // 4. Bagian Terkait (Misal: BAK)
        $bagian = User::updateOrCreate(
            ['email' => 'bak@alifah.ac.id'],
            [
                'name' => 'Kepala BAK',
                'password' => Hash::make('password'),
                'bagian_id' => 1, // Berelasi dengan tabel bagian ID 1 (BAK)
            ]
        );
        $bagian->assignRole('bagian_terkait');
    }
}
