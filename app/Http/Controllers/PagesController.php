<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use App\Like;
use App\Youtube;
use App\Collaborator;
use Auth;
use App\Category;
use Illuminate\Support\Facades\DB;

/**
 * Class PagesController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function welcome()
    {
        if(Auth::check()) return redirect('home');
        $tags = Tag::latest()
            ->take(20)
            ->get();
        return view('pages.welcome',compact('tags'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $topRated = $this->getHomeTopRated();
        $slider = $this->getHomeSlider();
        $moreViews = Post::has('media')->orderBy('views','desc')->public()->published()->take(4)->get();


        $userTags =  Auth::check() ? Auth::user()->getTagListAttribute()->toArray() : [];


        if(count($userTags) > 0 )
        {

            $posts = Post::has('media')->latest('published_date')->public()->published()->whereHas('tags', function($query) use ($userTags){
                $query->whereIn('tags.id',$userTags);
            })->paginate(5);
            if ($posts->currentPage() > 1)
            {
                $userTags =  Auth::user()->getTagListAttribute()->toArray();
                $posts = Post::has('media')->latest('published_date')->public()->published()->whereHas('tags', function($query) use ($userTags){
                    $query->whereIn('tags.id',$userTags);
                })->paginate(9);
            }
        }
        else{
            $posts = Post::has('media')->latest('published_date')->public()->published()->paginate(5);
            if ($posts->currentPage() > 1)
            {
                $posts = Post::has('media')->latest('published_date')->public()->published()->paginate(9);
            }
        }

        //video option
        $youtube = Youtube::first();
        $collaborators = Collaborator::latest()->has('category')->with('category')->take(3)->get();
        return view('pages.home', compact('posts','topRated','slider', 'youtube','collaborators','moreViews'));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function page(Request $request,$slug)
    {
        $moreViews = Post::whereHas('category', function ($query) use ($slug) {
            $query->where('categories.slug', $slug);
        })->has('media')->orderBy('views','desc')->public()->published()->take(4)->get();

        if (!empty($request->input('page')))
        {

            $posts = Post::whereHas('category', function ($query) use ($slug) {
                $query->where('categories.slug', $slug);
            })->has('media')->latest('published_date')->public()->published()->paginate(9);

        }
        else{
            $posts = Post::whereHas('category', function ($query) use ($slug) {
                $query->where('categories.slug', $slug);
            })->has('media')->latest('published_date')->public()->published()->paginate(5);
        }

        $category = Category::where('slug', $slug)->with('slider.images')->first();

        $slider = Post::whereHas('category', function ($query) use ($slug) {
            $query->where('categories.slug', $slug);
        })->has('media')->latest('published_date')->public()->published()->take(4)->get();

        if(empty($posts) || empty($category))
        {
            abort(404);
        }
        $youtube = Youtube::first();
        $collaborators = Collaborator::latest()->has('category')->with('category')->take(3)->get();

        $topRated = $this->getPageTopRated($slug);

        return view('pages.page', compact('posts', 'topRated', 'moreViews','category', 'slider','youtube','collaborators'));

    }

    public function terms()
    {
        return view('pages.termsAndConditions');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $search = $request->val;
            $posts = Post::search($search)->with('category')->has('media')->with('media')
               ->latest('published_date')->public()->published()->paginate(9);

            $tags = Tag::search($search);
            return response()->json(["posts"=>$posts, "tags"=>$tags]);
        }
        //return($data);
//        $search = $request->q;
//        if($search)
//        {
//            $posts = Post::search($search)->has('media')->with('media')
//                ->latest('published_date')->public()->published()->paginate(9);
//        }
//        else{
//            return back();
//        }
//        $posts = DB::select('select * from posts where title like ' . $search);
//        dd($posts);
//        return view('pages.result',compact('posts'));
//        return($posts);
    }

    public function getHomeSlider()
    {
        $slideOne = Post::whereHas('category', function ($query){
            $query->where('categories.slug', 'nutrition');
        })->has('media')->with('media')->latest('published_date')->public()->published()->first();
        $slideTwo = Post::whereHas('category', function ($query){
            $query->where('categories.slug', 'health');
        })->has('media')->with('media')->latest('published_date')->public()->published()->first();
        $slideThree= Post::whereHas('category', function ($query){
            $query->where('categories.slug', 'personal-grow');
        })->has('media')->with('media')->latest('published_date')->public()->published()->first();
        $slideFour= Post::whereHas('category', function ($query){
            $query->where('categories.slug', 'physical-activity');
        })->has('media')->with('media')->latest('published_date')->public()->published()->first();

        return [ $slideOne, $slideTwo, $slideThree, $slideFour];
    }

    public function getHomeTopRated()
    {
        $likes = Like::all();
        $topRated = array();

        foreach ($likes as $like){
            $total = ($like->motivador + $like->interesante + $like->satisfactorio + $like->informativo) - ($like->soso + $like->aburrido);
            if($total > 0)
            {
                $topRated[] = [
                    'post' => $like->post,
                    'likes' => $total
                ];
            }
        }

        $topRated = array_values(array_sort($topRated, function ($value) {
            return $value['likes'];
        }));
        $topRated = array_reverse(array_slice($topRated, -3, 3, true));

        return $topRated;
    }

    public function getPageTopRated($slug)
    {
        $likes = Like::all();
        $topRated = array();

        foreach ($likes as $like){
            $category =  Category::find($like->post->category_id);
            if($like->post && $category->slug == $slug)
            {
                $total = ($like->motivador + $like->interesante + $like->satisfactorio + $like->informativo) - ($like->soso + $like->aburrido);
                if($total > 0)
                {
                    $topRated[] = [
                        'post' => $like->post,
                        'likes' => $total
                    ];
                }
            }

        }

        $topRated = array_values(array_sort($topRated, function ($value) {
            return $value['likes'];
        }));
        $topRated = array_reverse(array_slice($topRated, -3, 3, true));

        return $topRated;
    }


}
