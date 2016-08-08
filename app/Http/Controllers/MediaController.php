<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Response;
use Validator;
use Auth;

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Media::latest('created_at')->paginate(12);
        return view('media.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'file' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $this->makeImage($request->file('file'));

        return Response::json('success', 200);
    }

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function makeImage(UploadedFile $file)
    {
        return Media::named($file->getClientOriginalName())->store($file);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param Media $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
//        $this->validate($request,[
//            'caption' => 'required'
//        ]);
        $media->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Media::findOrFail($id)->delete();
        return back();
    }

    /**
     * Add avatar image for user profile and collaborators.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function addAvatar(Request $request)
    {
        if($request->ajax()){

            $validator = Validator::make($request->all(), [
                'image-data' => 'required',
                'file' => 'required'
            ]);
            if ($validator->fails())
            {
                return Response::json(['error' =>'Imagen requerida'], 400);
            }
            if ($request->hasFile('file'))
            {
                $file = $request->file('file');
                $encoded = $request->input('image-data');
                $filteredData = substr( $encoded, strpos( $encoded, "," ) + 1 );
                $decodedData = base64_decode( $filteredData );
                $filename = 'uploads/avatars/' . time().$file->getClientOriginalName();
                $upload_success = file_put_contents($filename, $decodedData);
                if ($upload_success) {
                    $user = Auth::user();
                    $user->avatar = $filename;
                    $user->save();
                    return Response::json('success', 200);
                } else {
                    return Response::json('No se pudo salvar la imagen', 400);
                }
            }
            else{
                return "file not present";
            }
        }
        return back();
    }
}
