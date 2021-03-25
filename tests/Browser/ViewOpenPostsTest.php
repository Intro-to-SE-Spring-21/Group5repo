<?php

namespace Tests\Browser;

use Auth;
use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewOpenPostsTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Testing to see open posts
     *
     * @test
     */
    public function test_open_posts()
    {
        if (!Auth::check()) {

            $user = factory(User::class)->create([
                'first_name' => 'testfirstname',
                'last_name' => 'testlastname',
                'email' => 'test@example.com',
                'password' => bcrypt('testpass123')
            ]);

            $this->browse(function ($browser) use ($user) {
                $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'testpass123')
                    ->press('Login')
                    ->assertPathIs('/');
            });
        }
        $this->browse(function ($browser) {
            $browser->visit('/open/posts')
                ->assertSee('Currently Open Posts');
        });
    }
}
