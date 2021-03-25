<?php

namespace App\Services;

use App\SocialAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser($provider, ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $nameArray = explode(' ', trim($providerUser->getName()));
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'first_name' => $nameArray[0],
                    'last_name' => $nameArray[1],
                    'password' => md5(rand(1, 10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
