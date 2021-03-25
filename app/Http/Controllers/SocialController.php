<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Socialite;

class SocialController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback($provider, SocialAccountService $service)
    {
        $user = $service->createOrGetUser($provider, Socialite::driver($provider)->user());
        auth()->login($user);
        return redirect()->to('/home');
    }
}
