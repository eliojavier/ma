<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TagRequest;
use App\Tag;
use App\Category;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends Controller
{
    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('role:admin', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('category')->latest()->paginate(10);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('tags.create',compact('categories'));
    }


    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag($request->all());
        $tag->category()->associate($request->input('category'));
        $tag->save();
        return redirect('admin/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $tag->load('category');
        dd($tag);
        return view('tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $categories = Category::all();
        return view('tags.edit',compact('tag','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest|Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->category()->associate($request->input('category'));
        $tag->update($request->all());
        return redirect('admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
