<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    private array $news = [
        ['title' => 'Новость 1', 'body' => 'Тест новости 1', 'status' => '1'],
        ['title' => 'Новость 2', 'body' => 'Тест новости 2', 'status' => '2'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->news as $news) {
            News::updateOrCreate(['title' => $news['title']], $news);
        }
    }
}
