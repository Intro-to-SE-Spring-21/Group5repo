<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    use DatabaseMigrations;


    /**
     * Testing for Post creation
     *
     * @return void
     */
    public function test_post_creation(){
        factory(Post::class)->create([
            'title' => 'test title',
            'body' => 'test body',
            'category_id' => 1,
            'solved' => FALSE
        ]);
        $this->assertDatabaseHas('posts', ['body' => 'test body']);
    }

    /**
     * Testing for votes
     *
     * @return void
     */
    public function test_vote(){
        $post = factory(Post::class)->create();
        $user = User::first();

        $post->setVote($user, true);
        $this->assertNotEmpty($post->votes);

        $post->setVote($user, false);
        $this->assertEquals($post->votes()->first()->is_upvote, false);

        $post->setVote($user, false);
        $this->assertEmpty($post->votes()->get());
    }

}
