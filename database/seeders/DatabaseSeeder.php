<?php

namespace Database\Seeders;

use App\Models\NewsStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(NewsStatusSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(RoleUserSeeder::class);
         $this->call(PermissionRoleSeeder::class);
         $this->call(NewsSeeder::class);
    }
}
