<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
            'title' => 'required|min:3|unique:articles',
            'image' => 'image|max:1000',
            'body' => 'required',
            'tag_list' => 'required|exists:tags,id',
            'user_id' => 'exists:users,id',
        ];

        if ($this->isMethod('patch')) {
            $rules['title'] = 'required|min:3|max:60|unique:articles,title,'.
                $this->route('article')->id;
        }

        return $rules;
    }
}
