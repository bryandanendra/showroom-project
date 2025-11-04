<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin if exists
        User::where('email', 'admin@showroom.com')->delete();
        User::where('email', 'user@example.com')->delete();

        // Create admin user
        User::create([
            'name' => 'Admin Showroom',
            'email' => 'admin@showroom.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Showroom No. 123, Jakarta',
        ]);

        // Create demo regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Jl. Customer No. 456, Jakarta',
        ]);
    }
}
