<?php

namespace App\Rules\Message;

use App\Models\Rooms;
use App\Models\RoomUsers;
use App\Utils\JWTUtils;
use Illuminate\Contracts\Validation\Rule;

class CorrectRoomRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $status = RoomUsers::where('room_id', $value)->where('user_id', JWTUtils::getUserID())->count();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Send the message failed.';
    }
}
