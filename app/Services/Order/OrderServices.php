<?php

namespace App\Services\Order;

use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Utils\JWTUtils;
use App\Utils\ModelRelationsUtils;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderServices
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
                $order = new Orders($request->all());
                $order->created_by = JWTUtils::getUserID();
                $order->id = Utils::generateUUID();
                $order->status = 'created';

                if ($order->save()) {
                    foreach ($request->order_items as $item) {
                        $orderItem = new OrderItems($item);
                        $orderItem->order_id = $order->id;
                        $orderItem->id = Utils::generateUUID();
                        $orderItem->save();
                        $item = Items::where('id', $orderItem->item_id)->first();
                        if (($item->available_quantity -= $orderItem->quantity) < 0) {
                            DB::rollBack();
                            return ['error' => 'Available selling product quantity is not enough!'];
                        }
                        $item->reserved_quantity += $orderItem->quantity;
                        $item->save();
                    }
                    $order = ModelRelationsUtils::OrderRelations($order);
                    return $order;
                } else {
                    DB::rollBack();
                    return ['error' => 'Add new order failed!'];
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return ['error' => 'Add new order failed!'];
            }
        });

        return $res;
    }
}
