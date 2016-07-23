<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
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

    private function getProtectedNames()
    {
        return 'administrator,admin,админ,администратор';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'role_id' => 'not_in:1,2|exists:roles,id',
            // 'name' => 'required|max:255',
            'name' => 'protected_names:'.$this->getProtectedNames().
                '|required|max:30|min:2|unique:users,name,'.$this->route('profile'),
            'email' => 'required|email|max:60|unique:users,email,'.$this->route('profile'),
            'sex' => 'required|in:0,1,2',
            'user_status' => 'max:60',
            'caption' => 'max:60',
            'birthday' => 'date',
            'skype' => 'max:50',
            'icq' => 'max:50',
        ];
    }
}
