<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\Transformers\PostTransformer;
use App\Post;
use App\User;
use Validator;

class ApiPostController extends ApiController {

    /**
     * @var \App\Helpers\Transformers\PostTransformer
     */
    protected $postTransformer;

    function __construct(PostTransformer $postTransformer)
    {
        $this->postTransformer = $postTransformer;
    }

    public function detail($id)
    {
        $post = Post::find($id);
        if ($post) {
            $related = Post::where('id', '!=', $post->id)->whereHas('category', function ($query) use ($post) {
                $query->where('categories.slug', $post->category->slug);
            })->has('media')->latest('published_date')->public()->published()->take(3)->get();

            return $this->respond([
                'article' => $this->postTransformer->transformDetail($post, $related->all())
            ]);
        }

        return $this->respondNotFound([
            'title' => 'Lo Sentimos',
            'body'  => 'Ningun articulo cumple con el parametro de busqueda.'
        ]);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keyword'  => 'sometimes|required',
            'category' => 'sometimes|required',
            'limit'    => 'sometimes|required',
            'user_id'  => 'sometimes|required',
            'latest'   => 'sometimes|required'

        ]);

        $limit = ! empty($request->input('limit')) ? (integer) $request->input('limit') : 9;

        if ($validator->fails()) {
            return $this->respondInvalidParameters($validator->getMessageBag()->toArray());
        } elseif ( ! empty($request->input('keyword'))) {
            $search = $request->input('keyword');

            $posts = Post::search($search)->has('media')->with('media')
                ->latest('published_date')->public()->published()->paginate($limit);

            if ($posts) {
                $posts->appends(['keyword' => $search]);
                $posts->appends(['limit' => $limit]);

                return $this->respondWithPagination($posts, [
                    'articles' => $this->postTransformer->transformCollection($posts->all())
                ]);
            }

            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'Ningun articulo cumple con el parametro de busqueda.'
            ]);
        } elseif ( ! empty($request->input('category'))) {

            $category = (integer) $request->input('category');
            $posts = Post::where('category_id', $category)->has('media')->with('media')
                ->latest('published_date')->public()->published()->paginate($limit);


            if ($posts) {
                $posts->appends(['category' => $category]);
                $posts->appends(['limit' => $limit]);

                return $this->respondWithPagination($posts, [
                    'articles' => $this->postTransformer->transformCollection($posts->all())
                ]);
            }

            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'Ningun articulo cumple con el parametro de busqueda.'
            ]);
        } elseif ( ! empty($request->input('user_id'))) {
            $userId = $request->input('user_id');
            $user = User::find($userId);
            if ( ! $user) {
                return $this->respondNotFound([
                    'title' => 'Lo Sentimos',
                    'body'  => 'Usuario no encontrado'
                ]);
            }
            $userTags = $user->getTagListAttribute()->toArray();

            if (count($userTags) > 0) {

                $posts = Post::has('media')->latest('published_date')->public()->published()->whereHas('tags', function ($query) use ($userTags) {
                    $query->whereIn('tags.id', $userTags);
                })->paginate($limit);

                if ($posts) {
                    $posts->appends(['user_id' => $userId]);
                    $posts->appends(['limit' => $limit]);

                    return $this->respondWithPagination($posts, [
                        'articles' => $this->postTransformer->transformCollection($posts->all())
                    ]);
                }

                return $this->respondNotFound([
                    'title' => 'Lo Sentimos',
                    'body'  => 'Ningun articulo cumple con el parametro de busqueda.'
                ]);

            } else {
                return $this->respondNotFound([
                    'title' => 'Lo Sentimos',
                    'body'  => 'Este usuario no tiene intereses asociados.'
                ]);

            }
        }elseif ( ! empty($request->input('latest'))) {
            $total = (integer) $request->input('latest');
            $posts = Post::has('media')->with('media')
                ->latest('published_date')->public()->published()->take($total)->get();

            if ($posts) {

                return $this->respond([
                    'articles' => $this->postTransformer->transformCollection($posts->all())
                ]);
            }

            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'Ningun articulo cumple con el parametro de busqueda.'
            ]);

        }

        return $this->respondInvalidParameters([
            'title' => 'Lo Sentimos',
            'body'  => 'Introduzca algun parametro de busqueda valido.'
        ]);
    }

}
