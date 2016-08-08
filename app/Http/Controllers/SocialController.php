<?php namespace App\Http\Controllers;


use Laravel\Socialite\Contracts\Factory as Socialite;
use App\SocialAuthenticateUser;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function __construct(Socialite $socialite){
        $this->socialite = $socialite;
    }


    public function getSocialAuth(SocialAuthenticateUser $authenticateUser, Request $request, $provider=null)
    {
        //just to handle providers that doesn't exist
        if(!config("services.$provider")) abort('404');

        return $authenticateUser->execute($request->has('code'), $this, $provider);
    }

    public function userHasLoggedIn($user) {
        return redirect('/home');
    }

}