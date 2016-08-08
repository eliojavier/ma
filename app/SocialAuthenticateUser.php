<?php
/**
 * Created by PhpStorm.
 * User: enrique
 * Date: 02/07/16
 * Time: 11:47 PM
 */

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;

class SocialAuthenticateUser {

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($hasCode, $listener, $provider)
    {
        if (!$hasCode) return $this->getAuthorizationFirst($provider);
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider));
        $this->auth->login($user, true);
        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }
}