<?php

namespace App\Templates\Flows;

use App\Http\Requests\Order\NewOrderRequest;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\NormalCollection;
use App\Http\Resources\NormalResource;
use App\Http\Resources\Order\Order;
use App\Http\Resources\Order\OrderCollection;
use App\Models\Orders;
use App\Services\Order\OrderServices;
use App\Templates\FlowTemplate;
use App\Utils\JWTUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class OrderTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $validator = Validator::make($request->all(), OrderRequest::rules());
                return $validator;
                break;
            case 'store':
                $validator = Validator::make(array_merge($request->all(), ['created_by' => JWTUtils::getUserID()]), NewOrderRequest::rules());
                return $validator;
                break;
            default:
                $validator = Validator::make($request->all(), OrderRequest::rules());
                return $validator;
                break;
        }
    }

    protected function doProcess(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $orders = Orders::all();
                return $orders;
                break;
            case 'store':
                $data = OrderServices::getInstance()->store($request);
                return $data;
                break;
            default:
                $orders = Orders::all();
                return $orders;
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
