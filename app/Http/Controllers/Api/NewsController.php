<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\NewsForAdmin;
use App\Http\Requests\NewsListForAdmin;
use App\Http\Requests\NewsListRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\UpdateNewsStatusRequest;
use App\Http\Resources\DataResult;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsResourceCollection;
use App\Services\NewsService;

class NewsController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getNewsList(NewsListRequest $request): NewsResourceCollection
    {
        $newsList = $this->newsService->getNewsList($request->validated());
        return new NewsResourceCollection($newsList);
    }

    public function getNews(NewsRequest $request): NewsResource
    {
        $news = $this->newsService->getNews($request->validated()['id']);
        return new NewsResource($news);
    }

    public function getNewsListForAdmin(NewsListForAdmin $request): NewsResourceCollection
    {
        $newsList = $this->newsService->getNewsListForAdmin($request->validated());
        return new NewsResourceCollection($newsList);
    }

    public function getNewsForAdmin(NewsForAdmin $request): NewsResource
    {
        $news = $this->newsService->getNewsForAdmin($request->validated()['id']);
        return new NewsResource($news);
    }

    public function createNews(CreateNewsRequest $request): NewsResource
    {
        $news = $this->newsService->createNews($request->validated());
        return new NewsResource($news);
    }

    public function updateNewsStatus(UpdateNewsStatusRequest $request): DataResult
    {
        $isUpdated = $this->newsService->updateNewsStatus($request->validated());
        return (new DataResult($isUpdated))->result;
    }
}
