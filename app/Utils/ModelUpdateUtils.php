<?php

namespace App\Utils;

class ModelUpdateUtils
{
    public static function ItemListRelations($model, $request)
    {
        $keys = array_keys($request->all());
        foreach ($keys as $key) {
            $model[$key] = $request[$key];
        }
        return $model;
    }
}
