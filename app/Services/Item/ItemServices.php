<?php

namespace App\Services\Item;

use App\Models\Follows;
use App\Models\Items;
use App\Services\MailServices;
use App\Utils\ModelRelationsUtils;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemServices
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
        $item = new Items($request->all());
        $item->id = Utils::generateUUID();
        $item->provider_id = $request->id;

        if ($item->save()) {
            $item = ModelRelationsUtils::ItemRelations($item);
            return $item;
        } else {
            return ['error' => 'Add new item failed!'];
        }
    }

    public function update(Request $request) {
        $follow = Follows::where('requester_id', $request->requester_id)->where('addressee_id', $request->addressee_id)->where('status', 'requesting')->first();
        $follow->status = 'followed';

        if ($follow->save()) {
            $follow = ModelRelationsUtils::ItemRelations($follow);
            // $this->sendAcceptEmail($follow);
            return $follow;
        } else {
            return ['error' => 'Follow accept failed!'];
        }
    }

    public function showSelfItem(Request $request) {
        $item = Items::where('provider_id', $request->id)->paginate(15);

        if ($item) {
            $item = ModelRelationsUtils::ItemListRelations($item);
            return $item;
        } else {
            return ['error' => 'Get self items failed!'];
        }
    }
}
