<?php

namespace App\Templates\Flows;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Follow\FollowAccept;
use App\Http\Requests\Follow\FollowRequest;
use App\Http\Requests\Follow\ShowUserFriendListRequest;
use App\Http\Resources\NormalCollection;
use App\Http\Resources\NormalResource;
use App\Models\Follows;
use App\Services\Follow\FollowServices;
use App\Templates\FlowTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;

class FollowTemplate extends FlowTemplate
{
    protected function doValidate(Request $request, string $operation)
    {
        switch ($operation) {
            case 'index':
                $validator = Validator::make($request->all(), LoginRequest::rules());
                return $validator;
                break;
            case 'store':
                $validator = Validator::make($request->all(), FollowRequest::rules($request));
                return $validator;
                break;
            case 'update':
                $validator = Validator::make($request->all(), FollowAccept::rules($request));
                return $validator;
                break;
            case 'showUserFriend':
                $validator = Validator::make($request->all(), ShowUserFriendListRequest::rules($request));
                return $validator;
                break;
            case 'showFollowRequest':
                $validator = Validator::make($request->all(), ShowUserFriendListRequest::rules($request));
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
                $data = FollowServices::getInstance()->index($request);
                return $data;
                break;
            case 'store':
                $data = FollowServices::getInstance()->store($request);
                return $data;
                break;
            case 'update':
                $data = FollowServices::getInstance()->update($request);
                return $data;
                break;
            case 'showUserFriend':
                $data = FollowServices::getInstance()->showUserFriend($request);
                return $data;
                break;
            case 'showFollowRequest':
                $data = FollowServices::getInstance()->showFollowRequest($request);
                return $data;
                break;
            default:
                $data = Follows::all();
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
            return Response::errorUnauthorized('Email or Password incorrect.');
        }
    }
}
