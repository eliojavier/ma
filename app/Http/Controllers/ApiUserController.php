<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Worker;
use App\Helpers\Transformers\UserTransformer;
use Validator;


class ApiUserController extends ApiController {

    /**
     * @var \App\Helpers\Transformers\UserTransformer
     */
    protected $userTransformer;

    function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->json()->all();
//        dd(array_flatten($request['user']['interests']));

        $validator = Validator::make($request['user'], [
            'fullName'   => 'required',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|min:6',
            'ci'         => 'sometimes|required|unique:users,document',
            'interests'  => 'required',
            'newsletter' => 'required'
        ]);

        $document = ! empty($request['user']['ci']) ? $request['user']['ci'] : null;

        if ($validator->fails()) {
            return $this->respondInvalidParameters($validator->getMessageBag()->getMessages());
        } elseif ( ! empty($document) && count(Worker::where('document', $document)->get()) === 0) {
            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'La cédula introducida no posee Servicio Empresarial Motivapp asociado'
            ]);
        }
        $nameArr = explode(' ', $request['user']['fullName'], 2);
        $user = User::create([
            'first_name' => $nameArr[0],
            'last_name'  => ! empty($nameArr[1]) ? $nameArr[1] : '',
            'email'      => $request['user']['email'],
            'password'   => bcrypt($request['user']['password']),
            'document'   => $document,
            'newsletter' => $request['user']['newsletter']
        ]);
        $user->makeSubscriber();

        $this->syncTags($user, array_flatten($request['user']['interests']));

        return $this->respondCreated('Usuario creado exitosamente.', 'user', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        dd($user);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Sync up list of tags in the database.
     * @param User $user
     * @param array $tags
     */
    public function syncTags(User $user, array $tags)
    {
        $user->tags()->sync($tags);
    }

    public function checkEnterprise(Request $request)
    {
        $request = $request->json()->all();

        $validator = Validator::make($request['user'], [
            'id' => 'required',
            'ci' => 'required|unique:users,document',
        ]);

        $document = ! empty($request['user']['ci']) ? $request['user']['ci'] : null;

        if ($validator->fails()) {
            return $this->respondInvalidParameters($validator->getMessageBag()->toArray());
        } elseif ( ! empty($document) && count(Worker::where('document', $document)->get()) === 0) {
            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'La cédula introducida no posee Servicio Empresarial Motivapp asociado'
            ]);
        }
        $user = User::find($request['user']['id']);
        if ( ! $user) {
            return $this->respondNotFound([
                'title' => 'Lo Sentimos',
                'body'  => 'Usuario no encontrado'
            ]);
        }
        $user->update([
            'document' => $document
        ]);

        return $this->respond([
            'message' => [
                "title" => "Felicitaciones",
                "body"  => "Su cuenta ahora posee Servicio Empresarial Motivapp"
            ],
            'user'    => $this->userTransformer->transform($user)
        ]);
    }

    public function search(Request $request)
    {
        $request = $request->json()->all();

        $validator = Validator::make($request['user'], [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondInvalidParameters($validator->getMessageBag()->toArray());
        } else {
            $user = User::find($request['user']['id']);
            if ( ! $user) {
                return $this->respondNotFound([
                    'title' => 'Lo Sentimos',
                    'body'  => 'Usuario no encontrado'
                ]);
            }

            return $this->respond([
                'user' => $this->userTransformer->transform($user)
            ]);
        }
    }
}
