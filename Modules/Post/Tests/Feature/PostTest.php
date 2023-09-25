<?php

namespace Modules\Post\Tests\Feature;

use Modules\Post\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Post\Entities\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_retrieve_posts(): void
    {
        User::factory()
            ->has(Post::factory()->count(1))
            ->count(1)
            ->create();


        $this->getJson('/api/posts')
             ->assertJsonStructure([
                 'data' => [
                     '*' => [
                         'id',
                         'title',
                         'body',
                         'user' => [
                             'id',
                             'name',
                         ],
                     ],
                 ],
             ]);
    }

    public function test_search_posts(): void
    {
        Post::factory()
            ->count(1)
            ->create([
                'title' => $search = 'test search asdsad',
            ]);

        $response = $this->getJson('/api/posts', [
            'search' => $search,
        ]);

        $response->assertJsonFragment([
            'title' => $search,
        ]);
    }

    public function test_search_not_existed_title_posts(): void
    {
        Post::factory()
            ->count(1)
            ->create([
                'title' => 'title that does not exists',
            ]);

        $search = ['search' => 'search some not existing title'];

        $this->getJson('/api/posts', $search)
             ->assertJsonMissing($search);
    }


    public function test_create_posts(): void
    {
        $user = User::factory()
                    ->create();

        $postData = [
            'user_id' => $user->id,
            'title'   => 'test',
            'body'    => 'test body',
        ];

        $this->postJson('/api/posts', $postData)
             ->assertCreated();

        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_create_posts_will_not_pass_with_wrong_data(): void
    {
        $this->postJson('/api/posts', [
            'user_id' => 1000,
            'title'   => 'test',
            'body'    => 'test body',
        ])
             ->assertUnprocessable()
             ->assertJsonValidationErrorFor('user_id');
    }

    public function test_delete_post()
    {
        $post = Post::factory()->create();

        $this->deleteJson("/api/posts/$post->id")
             ->assertNoContent();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    // those test are extremely basic
    // normally there would be lots of tests here
}
