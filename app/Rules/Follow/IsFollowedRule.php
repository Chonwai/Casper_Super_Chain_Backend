<?php

namespace App\Rules\Follow;

use App\Models\Follows;
use Illuminate\Contracts\Validation\Rule;

class IsFollowedRule implements Rule
{
    private $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
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
        $status1 = Follows::where('requester_id', $this->request->requester_id)->where('addressee_id', $this->request->addressee_id)->count();
        $status2 = Follows::where('requester_id', $this->request->addressee_id)->where('addressee_id', $this->request->requester_id)->count();
        if ($status1 || $status2) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You cannot send follow request again.';
    }
}
