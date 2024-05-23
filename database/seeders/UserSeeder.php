<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '081234567890',
            'role' => 'superadmin'
        ]);
    }
}
