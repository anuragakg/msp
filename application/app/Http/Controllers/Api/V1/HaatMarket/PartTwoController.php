<?php

namespace App\Http\Controllers\Api\V1\HaatMarket;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\HaatMarketTwoResource as ApiResource;
use App\Services\HaatMarketTwoService;

class PartTwoController extends ApiController
{

    protected $service;

    public function __construct(HaatMarketTwoService $haatMarketTwoService)
    {
        $this->service = $haatMarketTwoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission();
        $items = $this->service->getAll();

        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission();

        $reqBody = $request->all();
        $valid = $this->service->validateCreate($reqBody);
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        $data['status'] = 1; // By default status is 1.
        $data['created_by'] = 0;
        $data['updated_by'] = 0;

        $item = $this->service->createItem($data);


        $item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
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
        $this->checkPermission();
        $valid = $this->service->validateUpdate($id, $request->all());
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        try {
            $res = $this->service->updateItem($id, $data);
            $res = ApiResource::make($res);
            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission();
        try {

            $item = $this->service->getOne($id);

            $item = ApiResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    
}
