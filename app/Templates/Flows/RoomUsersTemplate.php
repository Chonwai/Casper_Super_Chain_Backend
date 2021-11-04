<?php

namespace App\Templates\Flows;

use App\Http\Requests\Room\ShowRoomUsersRequest;
use App\Http\Resources\NormalCollection;
use App\Http\Resources\NormalResource;
use App\Models\Messages;
use App\Models\Orders;
use App\Services\Message\MessageServices;
use App\Services\Room\RoomUsersServices;
use App\Templates\FlowTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class RoomUsersTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $validator = Validator::make($request->all(), []);
                return $validator;
                break;
            case 'show':
                $validator = Validator::make(array_merge($request->all(), ['room_id' => $request->id]), ShowRoomUsersRequest::rules());
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
                $orders = RoomUsersServices::getInstance()->all();
                return $orders;
                break;
            case 'show':
                $data = RoomUsersServices::getInstance()->show($request);
                return $data;
                break;
            default:
                $orders = RoomUsersServices::getInstance()->all();
                return $orders;
                break;
        }
    }

    protected function doResponse($data, string $resourcesType, $validator)
    {
        if (!isset($data['error'])) {
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
