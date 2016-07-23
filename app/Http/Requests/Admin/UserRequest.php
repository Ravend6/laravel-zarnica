<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $rules = [
            'name' => 'required|max:30|min:2|unique:users',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required|confirmed|min:6',
            'role_list' => 'required|exists:roles,id',
            'sex' => 'required|in:0,1,2',
            'user_status' => 'max:60',
            'caption' => 'max:60',
            'birthday' => 'date',
            'skype' => 'max:50',
            'icq' => 'max:50',
        ];

        if ($this->isMethod('patch')) {
            $rules['name'] = 'required|max:30|min:2|unique:users,name,'.$this->route('user')->id;
            $rules['email'] = 'required|max:30|min:2|unique:users,email,'.$this->route('user')->id;
            $rules['password'] = 'confirmed|min:6';
        }

        return $rules;
    }
}
