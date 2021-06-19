<?php

namespace App\Http\Controllers\Api\V1\Shg;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Shg\ShgViewOnePartTwoResource;

use Illuminate\Http\Request;
use App\Services\ShgFormService;

class ShgPartTwo extends ApiController
{


    private $service;

    public function __construct(ShgFormService $shgFormService)
    {
        $this->service = $shgFormService;
    }

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
        //$this->checkPermission('shg_management_add');
        $post_data=$request->all();
        $shgID=$post_data['shg_id'];
        $already_using=$this->service->is_using_in_proposal($shgID);
        if($already_using)
        {
            return $this->respondWithValidationError('This gather is already using in Proposal.You can not edit this');
        }
        $valid = $this->service->partTwoValidateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated(); 
        try {
            $res = $this->service->createPartTwo($data);
            $res = ShgViewOnePartTwoResource::make($res);
            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
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
        $this->checkPermission('shg_management_view');
        try {

            $data = $this->service->viewOnePartOne($id);
            $data = ShgViewOnePartTwoResource::make($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {
            return $this->respondNotFound($th);
        }
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
