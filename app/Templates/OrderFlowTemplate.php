<?php

namespace App\Templates;

use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Order\Order;
use App\Http\Resources\Order\OrderCollection;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class OrderFlowTemplate extends FlowTemplate
{
    protected function doValidate(Request $request)
    {
        $validator = Validator::make($request->all(), OrderRequest::rules());
        return $validator;
    }

    protected function doProcess(string $operation)
    {
        switch ($operation) {
            case 'index':
                $orders = Orders::all();
                return $orders;
            default:
                $orders = Orders::all();
                return $orders;
                break;
        }
    }

    protected function doResponse($data, string $resourcesType, $validator, bool $validatorStatus)
    {
        if ($validatorStatus) {
            if ($resourcesType == 'Collection') {
                return Response::success(new OrderCollection($data));
            } elseif ($resourcesType == 'JsonResource') {
                return Response::success(new Order($data));
            }
        } else {
            return Response::success($validator->errors()->messages());
        }
    }
}
