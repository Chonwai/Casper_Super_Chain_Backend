<?php

namespace App\Services\Room;

use App\Events\SendMessage;
use App\Models\Messages;
use App\Models\Rooms;
use App\Models\RoomUsers;
use App\Utils\JWTUtils;
use App\Utils\ModelRelationsUtils;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomUsersServices
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

    public function all() {
        $roomUsers = RoomUsers::all();

        if ($roomUsers) {
            return $roomUsers;
        } else {
            return ['error' => 'Get room member failed!'];
        }
    }

    public function show(Request $request)
    {
        $roomUsers = RoomUsers::where('room_id', $request->id)->get();

        if ($roomUsers) {
            $roomUsers = ModelRelationsUtils::RoomUsersListRelations($roomUsers);
            return $roomUsers;
        } else {
            return ['error' => 'Get room member failed!'];
        }
    }
}
