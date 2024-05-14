<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarketResource;
use App\Models\Market;
use App\Repositories\MarketRepositories\MarketRepositoryInterface;
use App\Repositories\MarketRepositories\MarketRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class MarketController extends BaseController
{


    private MarketRepositoryInterface $marketRepository;

    public function __construct(MarketRepositoryInterface $marketRepository
    ){
        $this->marketRepository = $marketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $list = $this->marketRepository->integrationList();

        return $this->sendResponse(MarketResource::collection($list), 'Integration list.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $item = $this->marketRepository->integrationCreate($input);

        if(!$item["status"]){
            return $this->sendError('Validation Error.', $item["message"]);
        }

        return $this->sendResponse(new MarketResource($item["data"]), 'Integration save');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market, $id): JsonResponse
    {
        $input = $request->all();
        $input["id"] = $id;

        $item = $this->marketRepository->integrationUpdate($input);

        if(!$item["status"]){
            return $this->sendError('Validation Error.', $item["message"]);
        }

        return $this->sendResponse(new MarketResource($item["data"]), 'Integration update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market, $id): JsonResponse
    {
        $this->marketRepository->integrationDelete($id);

        return $this->sendResponse([], 'Integration delete');
    }
}
