<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    private array $permitionsRoles = [

        ['user' => 'get-news-list'],
        ['user' => 'get-news'],
        ['admin' => 'full-access-get-news-list'],
        ['admin' => 'full-access-get-news'],
        ['admin' => 'add-news'],
        ['admin' => 'change-news-statuses'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permitionsRoles as $permitionRole) {
            if ( ($role = Role::where('alias', key($permitionRole))->first()) && ($permission = Permission::where('alias', $permitionRole)->first()) ) {
                $role->permissions()->attach($permission->id);
            }
        }
    }
}
