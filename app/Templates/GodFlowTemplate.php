<?php

namespace App\Templates;

use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class GodFlowTemplate
{
    final public function takeFlow(Request $request, FormRequest $formRequest)
    {
        $this->doValidate($request, $formRequest);
        $this->doProcess($request);
        $this->doResponse($data);
    }

    final protected function doValidate(Request $request, FormRequest $formRequest)
    {
        $validator = Validator::make($request->all(), $formRequest::insertCompanyRules());

        if ($validator->fails()) {
            $res = Utils::integradeResponseMessage(ResponseUtils::validatorErrorMessage($validator), false);
            return response()->json($res, 400);
        } else {
            $res = UsersServices::getInstance()->create($request);
            return response()->json($res, 200);
        }
    }

    abstract protected function doProcess(Request $request);

    final protected function doResponse($data) {
        return response()->json($data, 200);
    }
}
