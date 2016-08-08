<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use Illuminate\Http\Response;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest|Request $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->save();
        $this->syncRoles($user, $request->input('roles'));

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user = $user::with('posts')->get();

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        $this->syncRoles($user, $request->input('roles'));

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function syncRoles(User $post, array $roles)
    {
        $post->roles()->sync($roles);
    }

}
