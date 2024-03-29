<?php

namespace App\Templates;

use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Nette\Utils\Strings;

abstract class FlowTemplate
{
    private $validator;

    /**
     * Register new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $resourcesType ('Collection' or 'JsonResource')
     * @param  string $operation Controller API operation ('index', 'store', 'show', 'update', 'destory')
     * @return \Illuminate\Http\JsonResponse|Illuminate\Http\Resources\Json\ResourceCollection;
     */
    final public function takeFlow(Request $request, string $resourcesType, string $operation)
    {
        $validator = $this->doValidate($request, $operation);
        if ($validator->fails()) {
            return $this->doResponseWithFailValidate($validator);
        } else {
            $data = $this->doProcess($request, $operation);
            return $this->doResponse($data, $resourcesType, $validator);
        }
    }

    abstract protected function doValidate(Request $request, string $operation);

    abstract protected function doProcess(Request $request, string $operation);

    abstract protected function doResponse($data, string $resourcesType, $validator);

    final function doResponseWithFailValidate($validator) {
        return Response::fail($message='Validation Fail', $code = 422, $errors=$validator->errors()->messages());
    }
}
