<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password')
            ], [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password')
            ],
        ];
        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
