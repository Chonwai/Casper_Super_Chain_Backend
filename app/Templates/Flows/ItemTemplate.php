<?php

namespace App\Templates\Flows;

use App\Http\Requests\Item\NewItemRequest;
use App\Http\Requests\Item\ShowSpecificItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\NormalCollection;
use App\Http\Resources\NormalResource;
use App\Models\Items;
use App\Services\Item\ItemServices;
use App\Templates\FlowTemplate;
use App\Utils\JWTUtils;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ItemTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
            // $validator = Validator::make($request->all(), LoginRequest::rules());
            // return $validator;
            // break;
            case 'store':
                $validator = Validator::make($request->all(), NewItemRequest::rules());
                return $validator;
                break;
            case 'update':
                $validator = Validator::make(array_merge($request->all(), ['id' => $request->id, 'provider_id' => JWTUtils::getUserID()]), UpdateItemRequest::rules());
                return $validator;
                break;
            case 'show':
                $validator = Validator::make(array_merge($request->all(), ['id' => $request->id]), ShowSpecificItemRequest::rules());
                return $validator;
                break;
            case 'showSelfItem':
                $validator = Validator::make($request->all(), []);
                return $validator;
                break;
            default:
                $validator = Validator::make($request->all(), []);
                return $validator;
                break;
        }
    }

    protected function doProcess(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
            // $data = FollowServices::getInstance()->index($request);
            // return $data;
            // break;
            case 'store':
                $data = ItemServices::getInstance()->store($request);
                return $data;
                break;
            case 'update':
                $data = ItemServices::getInstance()->update($request);
                return $data;
                break;
            case 'show':
                $data = ItemServices::getInstance()->show($request);
                return $data;
                break;
            case 'showSelfItem':
                $data = ItemServices::getInstance()->showSelfItem($request);
                return $data;
                break;
            default:
                $data = Items::all();
                return $data;
                break;
        }
    }

    protected function doResponse($data, string $resourcesType, $validator)
    {
        if (!$data['error']) {
            if ($resourcesType == 'Collection') {
                return Response::success(new NormalCollection($data));
            } elseif ($resourcesType == 'JsonResource') {
                return Response::success(new NormalResource($data));
            }
        } else {
            return Response::errorBadRequest($data['error']);
        }
    }
}
