<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CollaboratorRequest;

use App\Collaborator;
use Illuminate\Http\Response;
use App\Category;
use App\Post;
class CollaboratorController extends Controller
{
    protected $alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collaborators = Collaborator::orderBy('complete_name','ASC')->get();
        $collaborators = $collaborators->groupBy(function($item,$key) {
            return $item->complete_name[0];     //treats the name string as an array
        })->sortBy(function($item,$key){      //sorts A-Z at the top level
                return $key;
            });
        $collaborators->toArray();
        $alphabet = $this->alphabet;
        return view('collaborators.index',compact('collaborators','alphabet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $collaborators = Collaborator::latest()->orderBy('complete_name')->paginate(6);
        return view('collaborators.create',compact('collaborators','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CollaboratorRequest|Request $request
     * @return Response
     */
    public function store(CollaboratorRequest $request)
    {
        $collaborator = new Collaborator($request->all());
        $collaborator->category_id = $request->input('category');
        $collaborator->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Collaborator $collaborator
     * @return Response
     */
    public function show(Collaborator $collaborator)
    {
        $id = $collaborator->category_id;
        $posts = Post::whereHas('category', function ($query) use ($id) {
            $query->where('categories.id', $id);
        })->has('media')->latest('published_date')->public()->published()->paginate(8);

        return view('collaborators.show',compact('collaborator','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Collaborator $collaborator
     * @return Response
     */
    public function edit(Collaborator $collaborator)
    {
        $categories = Category::latest()->get();
        return view('collaborators.edit',compact('collaborator','categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param CollaboratorRequest|Request $request
     * @param Collaborator $collaborator
     * @return Response
     */
    public function update(CollaboratorRequest $request, Collaborator $collaborator)
    {
        $collaborator->update($request->all());
        $collaborator->category_id = $request->input('category');
        $collaborator->save();
        return redirect('collaborators/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Collaborator $collaborator
     * @return Response
     * @throws \Exception
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return back();
    }
}
