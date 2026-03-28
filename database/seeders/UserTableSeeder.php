<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name'     => 'Administrator',
            'email'    => 'admin@ukmtaripnc.com',
            'password' => Hash::make('admin123'),
            'level'    => 'admin',
        ]);
    }
}
