<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
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
            'ordered_by' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',
            'order_items' => 'required',
            'remark' => 'nullable'
        ];
    }
}
