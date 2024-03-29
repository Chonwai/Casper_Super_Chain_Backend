<?php

namespace App\Http\Requests\Follow;

use App\Rules\Follow\AddresseeRule;
use App\Rules\Follow\IsFollowedRule;
use App\Rules\Follow\IsRelatedUserRule;
use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
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
    public static function rules($request)
    {
        return [
            'requester_id' => ['required', 'exists:users,id', new IsRelatedUserRule($request), new IsFollowedRule($request)],
            'addressee_id' => ['required', 'exists:users,id', new AddresseeRule($request)],
        ];
    }
}
