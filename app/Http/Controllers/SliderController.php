<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slider;
use App\Category;
use App\Media;

class SliderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('images')->latest()->paginate(10);
        $categories = Category::latest()->get();

        return view('sliders.index',compact('sliders','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3'
        ]);
        $slider = new Slider([
            'name' => $request->name
        ]);

        if($request->has('category'))
        {
            $slider->category()->associate($request->input('category'));
        }
        $slider->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('sliders.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

    }

    /**
     * @param Request $request
     * @param Slider $slider
     * @return string
     */
    public function addPictures(Request $request,Slider $slider)
    {
        $this->validate($request,[
            'file' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);
        $file = $request->file('file');
        $slider->addImage(Media::named($file->getClientOriginalName())->store($file));
        return "test";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back();
    }
}
