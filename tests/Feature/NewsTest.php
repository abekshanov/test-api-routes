<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    private $accessToken;

    public function test_can_login_by_api()
    {
        $body = [
            'email' => 'admin@example.com',
            'password' => 'password'
        ];

        $this->json('POST', '/api/login', $body, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'token',
                'expires_at'
            ]);
    }

    public function test_can_create_news_by_admin()
    {
        $fields = [
            'title' => 'test title 1',
            'body' => 'test body 1',
        ];
        $this
            ->actingAs(User::where('email', 'admin@example.com')->first(), 'api')
            ->json('post', '/api/admin/createNews', $fields)
            ->assertStatus(201);
    }

    public function test_cannot_create_news_by_user()
    {
        $fields = [
            'title' => 'test title 1',
            'body' => 'test body 1',
        ];
        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('post', '/api/admin/createNews', $fields)
            ->assertStatus(403);

    }

    public function test_can_update_status_news_by_admin()
    {
        $news = News::updateOrCreate(['id' => 1], ['title' => 'test', 'body' =>'test', 'status' => 1]);
        $oldStatus = $news->status;

        $fields = [
            'status' => 2,
        ];

        $this
            ->actingAs(User::where('email', 'admin@example.com')->first(), 'api')
            ->json('put', 'api/admin/updateNewsStatus/1', $fields)
            ->assertJson(['data' => true, 'errors' => false])
            ->assertStatus(200);

        $this->assertTrue($oldStatus !== News::find(1)->status);
    }

    public function test_cannot_update_status_news_by_user()
    {
        $news = News::updateOrCreate(['id' => 1], ['title' => 'test', 'body' =>'test', 'status' => 1]);
        $oldStatus = $news->status;

        $fields = [
            'status' => 2,
        ];

        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('put', 'api/admin/updateNewsStatus/1', $fields)
            ->assertStatus(403);

        $this->assertTrue($oldStatus == News::find(1)->status);
    }

    public function test_can_get_news_list_by_admin()
    {
        $this
            ->actingAs(User::where('email', 'admin@example.com')->first(), 'api')
            ->json('get', 'api/admin/getNewsList')
            ->assertStatus(200);
    }

    public function test_cannot_get_news_list_by_user()
    {
        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('get', 'api/admin/getNewsList')
            ->assertStatus(403);
    }

    public function test_can_get_news_list_by_user()
    {
        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('get', 'api/getNewsList')
            ->assertStatus(200);
    }

    public function test_can_get_news_by_admin()
    {
        $this
            ->actingAs(User::where('email', 'admin@example.com')->first(), 'api')
            ->json('get', 'api/admin/getNews/1')
            ->assertStatus(200);
    }

    public function test_cannot_get_news_by_user()
    {
        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('get', 'api/admin/getNews/1')
            ->assertStatus(403);
    }

    public function test_can_get_news_by_user()
    {
        $this
            ->actingAs(User::where('email', 'user@example.com')->first(), 'api')
            ->json('get', 'api/getNews/1')
            ->assertStatus(200);
    }
}
