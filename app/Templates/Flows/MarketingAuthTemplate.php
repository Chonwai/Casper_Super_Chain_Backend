<?php

namespace App\Templates\Flows;

use App\Http\Requests\Auth\MarketingRegisterRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Order\Order;
use App\Http\Resources\Order\OrderCollection;
use App\Models\Orders;
use App\Services\Marketing\MarketingServices;
use App\Templates\FlowTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class MarketingAuthTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $validator = Validator::make($request->all(), MarketingRegisterRequest::rules());
                return $validator;
                break;
            case 'store':
                $validator = Validator::make($request->all(), MarketingRegisterRequest::storeRules());
                return $validator;
                break;
            default:
                $validator = Validator::make($request->all(), MarketingRegisterRequest::rules());
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
                $orders = MarketingServices::getInstance()->store($request);
                return $orders;
                break;
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
