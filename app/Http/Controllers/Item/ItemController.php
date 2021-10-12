<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Templates\Flows\ItemTemplate;
use App\Utils\RequestUtils;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        RequestUtils::addUserIDFromJWT($request);
        $flow = new ItemTemplate();
        $res = $flow->takeFlow($request, 'JsonResource', 'store');
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        RequestUtils::addProviderIDFromJWT($request);
        $flow = new ItemTemplate();
        $res = $flow->takeFlow($request, 'JsonResource', 'show');
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSelfItem(Request $request)
    {
        RequestUtils::addUserIDFromJWT($request);
        $flow = new ItemTemplate();
        $res = $flow->takeFlow($request, 'Collection', 'showSelfItem');
        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // RequestUtils::addProviderIDFromJWT($request);
        $flow = new ItemTemplate();
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
