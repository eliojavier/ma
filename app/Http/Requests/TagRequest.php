<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TagRequest extends Request {

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
                    'category'     => 'required',
                    'slug'         => 'unique:tags',
                    'display_name' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'category'     => 'required',
                    'slug'         => 'required',
                    'display_name' => 'required'
                ];
            }
            default:
                break;
        }
    }

    public function all()
    {
        $data = parent::all();
        $data['slug'] = $data['slug'] ? $data['slug'] : str_slug($data['display_name']);
        return $data;
    }
}
