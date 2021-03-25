<?php

namespace Tests\Browser;

use Auth;
use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Testing for login with wrong credentials
     *
     * @test
     */
    public function badLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'unknown@example.org')
                ->type('password', 'testpass123')
                ->press('Login')
                ->assertSee('These credentials do not match our records');
        });
    }

    /**
     * Testing for login and registration
     *
     * @test
     */
    public function test_login()
    {
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

    /**
     * Testing for logout
     *
     * @test
     */
    public function test_logout(){
        $this->browse(function($browser){
            $browser->visit('/logout')
                ->logout()
                ->assertGuest();
        });
    }

}
