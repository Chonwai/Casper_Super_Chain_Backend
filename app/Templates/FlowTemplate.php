<?php

namespace App\Templates;

use App\Http\Resources\ResourceFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class FlowTemplate
{
    private $validator;

    final public function takeFlow(Request $request, string $resourcesType, string $operation)
    {
        $validator = $this->doValidate($request);
        if ($validator->fails()) {
            return $this->doResponse([], $resourcesType, $validator, false);
        } else {
            $data = $this->doProcess($operation);
            return $this->doResponse($data, $resourcesType, $validator, true);
        }
    }

    // final protected function doValidate(Request $request, FormRequest $formRequest)
    // {
    //     $validator = Validator::make($request->all(), $formRequest::insertCompanyRules());

    //     if ($validator->fails()) {
    //         $res = Utils::integradeResponseMessage(ResponseUtils::validatorErrorMessage($validator), false);
    //         return response()->json($res, 400);
    //     } else {
    //         $res = UsersServices::getInstance()->create($request);
    //         return response()->json($res, 200);
    //         return Response::success(new OrderCollection($orders));
    //     }
    // }
    abstract protected function doValidate(Request $request);

    abstract protected function doProcess(string $operation);

    abstract protected function doResponse($data, string $resourcesType, $validator, bool $validatorStatus);

    // final protected function doResponse(ResourceFactory $factory) {
    //     return Response::success($factory);
    // }
}
