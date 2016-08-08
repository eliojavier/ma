<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'title'          => 'required|min:3|max:255',
                    'slug'           => 'max:255|unique:posts',
                    'author'         => 'required',
                    'body'           => 'required',
                    'published_date' => 'required|date',
                    'category'       => 'required',
                    'file'           => 'mimes:jpg,jpeg,png,bmp'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title'          => 'required|min:3|max:255',
                    'slug'           => 'required|max:255',
                    'author'         => 'required',
                    'body'           => 'required',
                    'published_date' => 'required|date',
                    'file'           => 'mimes:jpg,jpeg,png,bmp'
                ];
            }
            default:
                break;
        }

    }

    public function all()
    {
        $data = parent::all();
        $data['slug'] = $data['slug'] ? $data['slug'] : str_slug($data['title']);
        $data['body'] = e($data['body']);
        return $data;
    }
}
