<?php

namespace App\Http\Resources;

use App\Http\Resources\Order\Order;
use App\Http\Resources\Order\OrderCollection;

class ResourceFactory
{
    public static function createOrder($order)
    {
        return new Order($order);
    }

    public static function createOrderCollection($orders)
    {
        return new OrderCollection($orders);
    }
}
