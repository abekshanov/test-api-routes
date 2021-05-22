<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
        ['alias' => 'get-news-list', 'name' => 'Получение списка новостей'],
        ['alias' => 'get-news', 'name' => 'Получение конкретной новости'],
        ['alias' => 'full-access-get-news-list', 'name' => 'Получение списка новостей с полным доступом'],
        ['alias' => 'full-access-get-news', 'name' => 'Получение конкретной новости с полным доступом'],
        ['alias' => 'add-news', 'name' => 'Добавление новости'],
        ['alias' => 'change-news-statuses', 'name' => 'Изменение статуса новостей'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::updateOrCreate(['alias' => $permission['alias']], $permission);
        }
    }
}
