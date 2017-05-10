<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:20',
            'type' => 'required|exists:types,name',
            'priority' => 'required|integer|min:1|max:4',
            'contact' => 'required|numeric|min:00000|max:9999999999999999999999999',
            'notes' => 'min:10',
        ];
    }
}
