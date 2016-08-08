<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use App\Media;
use App\Slider;
use Validator;
use App\Like;
use Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Response;
class PostController extends Controller {

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','share']]);
        $this->middleware('role:admin', ['except' => ['show','share','likes']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->latest('published_date')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        $slider = Slider::latest()->get();
        return view('posts.create', compact('categories', 'tags','slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post($request->all());

        if ($request->hasFile('picture')) {
            $post->media()->associate($this->makeImage($request->file('picture')));

        }

        $post->category()->associate($request->input('category'));

        $post = Auth::user()->createdThisPost(
            $post
        );
        if($request->has('slider'))
        {
            $slider = Slider::findOrFail($request->input('slider'));
            $post->slider()->save($slider);
        }
        $tags =$request->input('tags');

        if(!empty($tags))
        {
            $this->syncTags($post,$tags);

        }

        return redirect('admin/posts');
    }

    public function makeImage(UploadedFile $file)
    {
        return Media::named($file->getClientOriginalName())->store($file);

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Post $post)
    {
        $count = $post->views + 1;

        $post->update([ 'views' => $count, 'published_date' => $post->published_date->format('d-m-Y')   ]);
        $post = $post->load('slider.images');

        $relatedPosts = Post::where('id','!=',$post->id)->whereHas('category', function ($query) use ($post){
             $query->where('categories.slug', $post->category->slug);
         })->has('media')->latest('published_date')->public()->published()->take(4)->get();
        return view('posts.show', compact('post','relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Post $post)
    {
        $slider = Slider::latest()->get();
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('posts.edit', compact('post', 'categories', 'tags','slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest|Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if ($request->hasFile('picture')) {
            $post->media()->associate($this->makeImage($request->file('picture')));

        }
        if($request->has('slider'))
        {

            $option = $request->input('slider');
            if($option == 'dettach')
            {
                $sliders = $post->slider()->get();
                if(count($sliders))
                {
                    foreach($sliders as $slider)
                    {
                        $slider->post_id = null;
                        $slider->save();
                    }
                }
            }
            else
            {
                $sliders = $post->slider()->get();
                if(count($sliders))
                {
                    foreach($sliders as $slider)
                    {
                        $slider->post_id = null;
                        $slider->save();
                    }
                }
                $slider = Slider::findOrFail($request->input('slider'));
                $post->slider()->save($slider);
            }

        }

        $post->category()->associate($request->input('category'));
        $tags =$request->input('tags');

        if(!empty($tags))
        {
            $this->syncTags($post,$tags);

        }
        $post->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    /**
     * Sync up list of tags in the database.
     * @param Post $post
     * @param array $tags
     */
    public function syncTags(Post $post, array $tags)
    {
        $post->tags()->sync($tags);
    }

    public function share(Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'count' => 'required',
                'id' => 'required'
            ]);
            if ($validator->fails())
            {
                return Response::json(['error' =>'Datos Faltantes'], 400);
            }
            $post = Post::findOrFail($request->input('id'));
            $post->share_counter = $request->input('count');
            $post->save();
            return Response::json('Exito', 200);
        }
    }

    public function likes(Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'count' => 'required',
                'id' => 'required',
                'type' => 'required'
            ]);
            if ($validator->fails())
            {
                return Response::json(['error' =>'Datos Faltantes'], 400);
            }

            $id =  $request->input('id');
            $count = $request->input('count');
            $like = new Like([
                'motivador' => $count,
                'post_id' => $id
            ]);
            Auth::user()->like()->save($like);

            return Response::json('Exito', 200);
        }
    }

}
