<?php

namespace App\Templates\Flows;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Order\Order;
use App\Http\Resources\Order\OrderCollection;
use App\Models\Orders;
use App\Services\Auth\AuthServices;
use App\Templates\FlowTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class AuthTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $validator = Validator::make($request->all(), LoginRequest::rules());
                return $validator;
                break;
            case 'store':
                $validator = Validator::make($request->all(), RegisterRequest::rules());
                return $validator;
                break;
            default:
                $validator = Validator::make($request->all(), RegisterRequest::rules());
                return $validator;
                break;
        }
    }

    protected function doProcess(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $data = AuthServices::getInstance()->index($request);
                return $data;
                break;
            case 'store':
                $data = Orders::all();
                return $data;
                break;
            default:
                $data = Orders::all();
                return $data;
                break;
        }
    }

    protected function doResponse($data, string $resourcesType, $validator)
    {
        if ($resourcesType == 'Collection') {
            return Response::success(new OrderCollection($data));
        } elseif ($resourcesType == 'JsonResource') {
            return Response::success(new Order($data));
        }
    }
}
