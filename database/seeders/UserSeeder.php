<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        User::updateOrCreate(
            ['email' => 'pcraft@gmail.com'],
            [
            'name' => 'Administrator',
            'password' => \Hash::make('pcraftpc'),
            'role' => 'admin',
            ]
        );
    }
}
