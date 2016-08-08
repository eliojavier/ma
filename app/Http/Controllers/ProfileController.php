<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Tag;
use App\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller {

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|collaborator|subscriber');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->load('tags');
        $tags = Tag::whereNotIn('id', Auth::user()->tags->lists('id')->toArray())->get();

        //percentage calculations
        $nutritionTotal = Auth::user()->tags()->where('category_id', 1)->count() * 100 / Tag::where('category_id', 1)->count();
        $healthTotal = Auth::user()->tags()->where('category_id', 2)->count() * 100 / Tag::where('category_id', 2)->count();
        $pgTotal = Auth::user()->tags()->where('category_id', 3)->count() * 100 / Tag::where('category_id', 3)->count();
        $activityTotal = Auth::user()->tags()->where('category_id', 4)->count() * 100 / Tag::where('category_id', 4)->count();

        return view('profile.index', compact('user', 'tags', 'nutritionTotal', 'healthTotal', 'pgTotal', 'activityTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function changePassword(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:6',
                'password'     => 'required|min:6|confirmed',
            ]);
            if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400);
            }
            $user = Auth::user();

            if ($user) {
                if (Hash::check($request->input('old_password'), $user->password)) {
                    $user->password = bcrypt($request->input('password'));
                    $user->save();
                    return Response::json('Contraseña cambiada con exito', 200);

                }
                return Response::json(array(
                    'success' => false,
                    'errors' => ['key' => 'Contraseña antigua no coincide.']
                ), 400);

            }
        }
        return back();
    }

    public function addTags(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => 'Datos Faltantes'], 400);
            }
//            $tag = Tag::findOrFail($request->input('id'));
            Auth::user()->tags()->attach($request->input('id'));

            return Response::json('Exito', 200);
        }
    }

    public function removeTags(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => 'Datos Faltantes'], 400);
            }
//            $tag = Tag::findOrFail($request->input('id'));
            Auth::user()->tags()->detach($request->input('id'));

            return Response::json('Exito', 200);
        }
    }

}
