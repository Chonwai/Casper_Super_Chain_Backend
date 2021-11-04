<?php

namespace App\Http\Requests\Room;

use App\Rules\Message\CorrectRoomRule;
use Illuminate\Foundation\Http\FormRequest;

class ShowRoomUsersRequest extends FormRequest
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
            'room_id' => ['required', 'exists:rooms,id', new CorrectRoomRule],
        ];
    }
}
