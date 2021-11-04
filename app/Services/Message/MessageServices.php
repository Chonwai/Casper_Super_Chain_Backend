<?php

namespace App\Services\Message;

use App\Events\SendMessage;
use App\Models\Messages;
use App\Models\Rooms;
use App\Utils\JWTUtils;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageServices
{
    private static $_instance = null;

    private function __construct()
    {
        // Avoid constructing this class on the outside.
    }

    private function __clone()
    {
        // Avoid cloning this class on the outside.
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $res = DB::transaction(function () use ($request) {
            try {
                $message = new Messages($request->all());
                $message->id = Utils::generateUUID();
                $message->sender_id = JWTUtils::getUserID();

                if ($message->save()) {
                    $room = Rooms::where('id', $message->room_id)->first();
                    $room->last_message_id = $message->id;
                    $room->save();
                    event(new SendMessage($request));
                    return $message;
                } else {
                    DB::rollBack();
                    return ['error' => 'Send message failed!'];
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return ['error' => 'Send message failed!'];
            }
        });

        return $res;
    }
}
