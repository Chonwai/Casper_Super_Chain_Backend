<?php

namespace App\Services\Follow;

use App\Models\Follows;
use App\Services\MailServices;
use App\Utils\ModelRelationsUtils;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FollowServices
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

    public function index() {
        // 
    }

    public function store(Request $request)
    {
        $follow = new Follows($request->all());
        $follow->id = Utils::generateUUID();
        $follow->status = 'requesting';

        if ($follow->save()) {
            $follow = ModelRelationsUtils::FollowRelations($follow);
            $this->sendNewRequestEmail($follow);
            return $follow;
        } else {
            return ['error' => 'Follow request failed!'];
        }
    }

    public function update(Request $request) {
        $follow = Follows::where('requester_id', $request->requester_id)->where('addressee_id', $request->addressee_id)->where('status', 'requesting')->first();
        $follow->status = 'followed';

        if ($follow->save()) {
            $follow = ModelRelationsUtils::FollowRelations($follow);
            $this->sendAcceptEmail($follow);
            return $follow;
        } else {
            return ['error' => 'Follow accept failed!'];
        }
    }

    public function showUserFriend(Request $request) {
        $follow = Follows::followed()->where(function($query) use ($request) {
            $query->where('requester_id', $request->id)->orWhere->where('addressee_id', $request->id);
        })->paginate(15);

        if ($follow) {
            $follow = ModelRelationsUtils::FollowListRelations($follow);
            return $follow;
        } else {
            return ['error' => 'Get friends list failed!'];
        }
    }

    public function showFollowRequest(Request $request) {
        $follow = Follows::requesting()->where('addressee_id', $request->id)->where('status', 'requesting')->paginate(15);

        if ($follow) {
            $follow = ModelRelationsUtils::FollowListRelations($follow);
            return $follow;
        } else {
            return ['error' => 'Get friends request failed!'];
        }
    }

    public function showFollowAccepted(Request $request) {
        $follow = Follows::followed()->where('addressee_id', $request->id)->where('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())->paginate(15);

        if ($follow) {
            $follow = ModelRelationsUtils::FollowListRelations($follow);
            return $follow;
        } else {
            return ['error' => 'Get friends accepted failed!'];
        }
    }

    public function sendNewRequestEmail($follow)
    {
        MailServices::getInstance()->sendNewFollowRequest($follow);
    }

    public function sendAcceptEmail($follow)
    {
        MailServices::getInstance()->sendFollowAccepted($follow);
    }
}
