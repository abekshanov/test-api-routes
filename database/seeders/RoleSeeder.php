<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = [
        ['alias' => 'admin', 'name' => 'Администратор'],
        ['alias' => 'user', 'name' => 'Пользователь'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::updateOrCreate(['alias' => $role['alias']], $role);
        }
    }
}
