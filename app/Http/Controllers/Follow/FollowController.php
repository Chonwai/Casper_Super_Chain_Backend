<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use App\Templates\Flows\FollowTemplate;
use App\Utils\JWTUtils;
use App\Utils\RequestUtils;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flow = new FollowTemplate();

        $res = $flow->takeFlow($request, 'JsonResource', 'store');

        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showUserFriend(Request $request)
    {
        RequestUtils::addUserIDFromJWT($request);

        $flow = new FollowTemplate();

        $res = $flow->takeFlow($request, 'Collection', 'showUserFriend');

        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $flow = new FollowTemplate();

        $res = $flow->takeFlow($request, 'JsonResource', 'update');

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
