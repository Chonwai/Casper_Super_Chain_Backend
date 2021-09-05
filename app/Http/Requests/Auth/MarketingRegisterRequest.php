<?php

namespace App\Http\Requests\Auth;

use App\Rules\RoleRule;
use Illuminate\Foundation\Http\FormRequest;

class MarketingRegisterRequest extends FormRequest
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
            // 
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function storeRules()
    {
        return [
            'name' => 'required',
            'role' => ['required', new RoleRule],
            'email' => 'required|email|unique:users',
            'password' => 'nullable|min:8',
        ];
    }
}
