<?php

namespace App\Http\Requests\Follow;

use App\Rules\Follow\AddresseeRule;
use App\Rules\Follow\IsFollowedRule;
use App\Rules\Follow\IsRelatedUserRule;
use App\Rules\Follow\IsRequestRule;
use App\Rules\Follow\RequesterRule;
use Illuminate\Foundation\Http\FormRequest;

class FollowAccept extends FormRequest
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
            'id' => ['required', 'exists:follows,id', new IsRequestRule($request)],
            'requester_id' => ['required', 'exists:users,id', new RequesterRule($request)],
            'addressee_id' => ['required', 'exists:users,id', new IsRelatedUserRule($request)],
        ];
    }
}
