<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{
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
                    'display_name' => 'required|min:3|max:255',
                    'slug'         => 'min:3|max:255|unique:categories'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'display_name' => 'required|min:3|max:255',
                    'slug'         => 'required|min:3|max:255'
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
