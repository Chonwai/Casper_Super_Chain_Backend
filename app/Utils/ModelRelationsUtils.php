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
            $model->items = $model->items;
        }
        return $model;
    }
}
