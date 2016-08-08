<?php namespace App\Repositories;

use App\User;

class UserRepository {

    public function findByUserNameOrCreate($userData)
    {

        $user = User::where('provider_id', $userData->id)->first();
        $registered = User::where('email', $userData->email)->first();
        if ( ! $user && ! $registered) {
            $nameArr = explode(' ', $userData->name, 2);
            $user = User::create([
                'provider_id' => $userData->id,
                'first_name'  => $nameArr[0],
                'last_name'   => $nameArr[1],
                'email'       => $userData->email,
                'avatar'      => $userData->avatar,
            ]);
            $user->makeSubscriber();
        } elseif ( ! $user && $registered) {
            $registered->provider_id = $userData->id;
            $registered->save();
            $user = $registered;
        }

        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, User $user)
    {
        $nameArr = explode(' ', $userData->name, 2);

        $socialData = [
//            'avatar'     => $userData->avatar,
            'email'      => $userData->email,
            'first_name' => $nameArr[0],
            'last_name'  => $nameArr[1],
        ];
        $dbData = [
//            'avatar'     => $user->avatar,
            'email'      => $user->email,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
        ];

        if ( ! empty(array_diff($socialData, $dbData))) {
//            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->first_name = $nameArr[0];
            $user->last_name = $nameArr[1];

            $user->save();
        }
    }
}