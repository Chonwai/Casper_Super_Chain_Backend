<?php

namespace App\Utils;

use App\Utils\Utils;

class ModelRelationsUtils
{
    public static function FollowRelations($model)
    {
        $model->requester = $model->requester;
        $model->addressee = $model->addressee;
        return $model;
    }
}
