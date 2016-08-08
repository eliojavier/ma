<?php namespace App\Helpers\Transformers;


class UserTransformer extends Transformer {


    public function transform($user)
    {
        $tagTransformer = new TagTransformer();

        return [
            'id'         => $user['id'],
            'fullName'   => $user['first_name'] . ' ' . $user['last_name'],
            'email'      => $user['email'],
            'ci'         => $user['document'],
            'newsletter' => $user['newsletter'],
            'interests' => $tagTransformer->transformCollection($user->tags->all())
        ];
    }
}