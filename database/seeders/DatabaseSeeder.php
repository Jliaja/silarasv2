<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      User::factory()->create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'nik' => '3201234567890002',
    'password' => Hash::make('12345678'),
    'role' => 'admin',
]);

User::factory()->create([
    'name' => 'Warga',
    'email' => 'warga@example.com',
    'nik' => '3201234567890003',
    'password' => Hash::make('12345678'),
    'role' => 'warga',
]);
    }
}
