<?php

namespace App\Services\Item;

use App\Models\Items;
use App\Utils\JWTUtils;
use App\Utils\ModelRelationsUtils;
use App\Utils\ModelUpdateUtils;
use App\Utils\Utils;
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

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $item = new Items($request->all());
        $item->id = Utils::generateUUID();
        $item->provider_id = $request->id;

        try {
            $item->save();
            $item = ModelRelationsUtils::ItemRelations($item);
            return $item;
        } catch (\Throwable $th) {
            return ['error' => 'Add new item failed!'];
        }
    }

    public function update(Request $request)
    {
        $item = Items::where('id', $request->id)->where('provider_id', JWTUtils::getUserID())->first();
        $item = ModelUpdateUtils::ItemListRelations($item, $request);

        try {
            $item->save();
            $item = ModelRelationsUtils::ItemRelations($item);
            return $item;
        } catch (\Throwable $th) {
            return ['error' => 'Item update failed!'];
        }
    }

    public function show(Request $request)
    {
        $item = Items::where('id', $request->id)->where('provider_id', $request->provider_id)->first();

        try {
            $item = ModelRelationsUtils::ItemRelations($item);
            return $item;
        } catch (\Throwable $th) {
            return ['error' => 'Get the specific item failed!'];
        }
    }

    public function showSelfItem(Request $request)
    {
        $item = Items::where('provider_id', $request->id)->paginate(15);

        if ($item) {
            $item = ModelRelationsUtils::ItemListRelations($item);
            return $item;
        } else {
            return ['error' => 'Get self items failed!'];
        }
    }

    public function destroy(Request $request) {
        $item = Items::where('id', $request->id)->where('provider_id', JWTUtils::getUserID())->first();

        try {
            $item->delete();
            return $item;
        } catch (\Throwable $th) {
            return ['error' => 'Item delete failed!'];
        }
    }
}
