<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NewsService
{
    private Model $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }

    public function getNewsList(array $params): Collection
    {
        $query = $this->model
            ->select('title', 'updated_at');

        if (isset($params['title'])) {
            $query = $query->where('title', 'like', '%'.$params['title'].'%');
        }

        return $query->get();
    }

    public function getNews(int $id): ?Model
    {
        return $this->model
            ->select('title', 'body', 'updated_at')
            ->find($id);
    }

    public function getNewsListForAdmin(array $params): Collection
    {
        $query = $this->model
            ->select('title', 'status', 'updated_at');

        if (isset($params['title'])) {
            $query = $query->where('title', 'like', '%'.$params['title'].'%');
        }

        return $query->get();
    }

    public function getNewsForAdmin(int $id): ?Model
    {
        return $this->model
            ->select('title', 'body', 'status', 'updated_at')
            ->find($id);
    }

    public function createNews(array $fields): ?Model
    {
        return $this->model->create($fields);
    }

    public function updateNewsStatus(array $fields): bool
    {
        return $this->model
            ->query()
            ->where('id', $fields['id'])
            ->update($fields);
    }
}