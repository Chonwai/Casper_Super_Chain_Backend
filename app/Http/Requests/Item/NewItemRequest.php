<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class NewItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'id' => ['required', 'exists:users,id'],
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|gte:0',
            'amount' => 'required|numeric|gte:0',
            'product_code' => 'nullable',
        ];
    }
}
