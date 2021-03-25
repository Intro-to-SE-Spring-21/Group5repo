<?php

namespace Tests\Unit;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Testing for tag creation.
     *
     * @return void
     */
    public function test_tags(){
        $post = factory(Post::class)->create();
        factory(Tag::class)->create([
            'name' => 'Test'
        ]);
        $this->assertDatabaseHas('tags', ['name' => 'Test']);
        $this->assertNull($post->tags()->first());
        $post->tags()->sync($post,false);
        $this->assertNotNull($post->tags()->first());
    }
}
