<?php namespace App\Helpers\Transformers;


class TagTransformer extends Transformer {


    public function transform($tag)
    {
        return [
            'id'   => $tag['id'],
            'name' => $tag['display_name'],
        ];
    }
}