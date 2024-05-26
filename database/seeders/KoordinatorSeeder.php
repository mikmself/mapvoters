<?php

namespace Database\Seeders;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KoordinatorSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Koor 1',
            'email' => 'koor1@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '081972892892',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '1234567890123456',
            'foto' => 'koor1.jpg',
            'paslon_id' => 1,
            'user_id' => $user->id,
        ]);
    }
}
