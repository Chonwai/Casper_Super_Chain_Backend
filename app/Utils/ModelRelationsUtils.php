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
}
