<?php namespace App\Helpers\Transformers;


class PostTransformer extends Transformer {


    public function transform($post)
    {
        return [
            'id'       => $post['id'],
            "category" => $post['category_id'],
            "title"    => $post['title'],
            'slug'     => $post['slug'],
            "url"      => url('/') . "/" . $post->media->thumbnail_path,
            "date"     => $post['published_date']->toFormattedDateString()
        ];
    }

    public function transformDetail($post, $related)
    {
        return [
            'id'              => $post['id'],
            "category"        => $post['category_id'],
            "title"           => $post['title'],
            'slug'            => $post['slug'],
            "url"             => url('/') . "/" . $post->media->thumbnail_path,
            "articleUrl"      => route('posts.show', $post),
            "date"            => $post['published_date']->toFormattedDateString(),
            "authors"         => $post['author'],
            "body"            => html_entity_decode($post['body']),
            "relatedArticles" => $this->transformCollection($related)
        ];
    }
}