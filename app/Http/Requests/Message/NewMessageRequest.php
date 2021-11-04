<?php

namespace App\Http\Requests\Message;

use App\Rules\Message\CorrectRoomRule;
use App\Rules\Message\MessageTypeRule;
use App\Rules\Message\RecipientRule;
use Illuminate\Foundation\Http\FormRequest;

class NewMessageRequest extends FormRequest
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
            'sender_id' => 'required|exists:users,id',
            'recipient_id' => ['required', 'exists:users,id', new RecipientRule],
            'content' => 'required',
            'message_type' => ['required', new MessageTypeRule],
        ];
    }
}
