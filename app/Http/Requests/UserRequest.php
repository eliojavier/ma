<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

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
                    'first_name' => 'required|max:255',
                    'last_name'  => 'required|max:255',
                    'email'      => 'required|email|max:255|unique:users',
                    'password'   => 'required|min:6',
                    'roles'        => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'first_name' => 'required|max:255',
                    'last_name'  => 'required|max:255',
                    'email'      => 'required|email|max:255',
                    'roles'        => 'required'
                ];
            }
            default:
                break;
        }

    }

    public function all(){
        $data = parent::all();
        $data['password'] =  bcrypt($data['password']);
        return $data;
    }
}
