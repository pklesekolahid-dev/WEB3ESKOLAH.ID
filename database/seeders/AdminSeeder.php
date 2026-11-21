<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'admin@desadigital.id')->delete();

        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@desadigital.id',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}