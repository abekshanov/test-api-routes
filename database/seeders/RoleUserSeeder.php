<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    private array $rolesUsers = [
        ['admin' => 'admin@example.com'],
        ['user' => 'user@example.com'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->rolesUsers as $roleUser) {
            if ( ($role = Role::where('alias', key($roleUser))->first()) && ($user = User::where('email', $roleUser)->first()) ) {
                $user->roles()->attach($role->id);
            }
        }
    }
}
