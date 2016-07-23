<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class BannedRequest extends Request
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
        return [
            'ended_at' => 'required|date_format:Y-m-d H:i:s'
        ];
    }
}
