<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Youtube;

class YoutubeController extends Controller
{
    protected $default = [
      'choices' => 'channel',
      'youtube_id' => 'UCpblBj3ulX9A3aJkhh5v3ew'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $youtube = Youtube::first();

        if(!count($youtube))
        {
            Youtube::create($this->default);
            $youtube = Youtube::first();
        }
        return view('admin.youtube',compact('youtube'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'youtube_id' => 'required'
        ]);

        $video = Youtube::findOrFail($id);
        $video->update($request->all());
        return back();
    }

}
