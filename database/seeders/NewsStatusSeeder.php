<?php

namespace Database\Seeders;

use App\Models\NewsStatus;
use Illuminate\Database\Seeder;

class NewsStatusSeeder extends Seeder
{
    private array $statuses = [
        'На утверждении',
        'Опубликована',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status) {
            NewsStatus::updateOrCreate(['name' => $status], ['name' => $status]);
        }
    }
}
