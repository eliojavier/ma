<?php namespace App\Helpers\Transformers;


class CategoryTransformer extends Transformer {


    public function transform($category)
    {
        $tagTransformer = new TagTransformer();
        return [
            'id'        => $category['id'],
            'name'      => $category['display_name'],
            'shortName' => $category['display_name'][0],
            'interests' => $tagTransformer->transformCollection($category->tags->all())
        ];
    }
}