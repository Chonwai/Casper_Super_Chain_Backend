<?php

namespace App\Utils;

class ModelRelationsUtils
{
    public static function FollowRelations($model)
    {
        $model->requester = $model->requester;
        $model->addressee = $model->addressee;
        return $model;
    }

    public static function FollowListRelations($model)
    {
        foreach ($model as $object) {
            $object->requester = $object->requester;
            $object->addressee = $object->addressee;
        }
        return $model;
    }

    public static function ItemRelations($model)
    {
        $model->provider = $model->provider;
        return $model;
    }

    public static function ItemListRelations($model)
    {
        foreach ($model as $object) {
            $object->provider = $object->provider;
        }
        return $model;
    }

    public static function OrderRelations($model)
    {
        $model->creator = $model->creator;
        $model->creator = $model->creator;
        $model->items = $model->items;
        return $model;
    }

    public static function OrderListRelations($model)
    {
        foreach ($model as $object) {
            $object->creator = $object->creator;
            $object->creator = $object->creator;
            $object->items = $object->items;
        }
        return $model;
    }

    public static function MessageRelations($model)
    {
        $model->sender = $model->sender;
        $model->recipient = $model->recipient;
        return $model;
    }

    public static function MessageListRelations($model)
    {
        foreach ($model as $object) {
            $object->sender = $object->sender;
            $object->recipient = $object->recipient;
        }
        return $model;
    }

    public static function RoomUsersRelations($model)
    {
        $model->room = $model->room;
        $model->member = $model->member;
        return $model;
    }

    public static function RoomUsersListRelations($model)
    {
        foreach ($model as $object) {
            $object->room = $object->room;
            $object->member = $object->member;
        }
        return $model;
    }
}
