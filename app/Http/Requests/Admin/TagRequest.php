<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class TagRequest extends Request
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
            'name' => 'required|unique:tags'
        ];

        if ($this->isMethod('patch')) {
            $rules['name'] = 'required|unique:tags,name,'.$this->route('tag')->id;
        }

        return $rules;
    }
}
