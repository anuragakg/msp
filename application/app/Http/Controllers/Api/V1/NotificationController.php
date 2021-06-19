<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\NotificationResource as ApiResource;
use App\Services\NotificationSendService;

class NotificationController extends ApiController
{
    protected $service;

    public function __construct(NotificationSendService $notificationSendService)
    {
        $this->service = $notificationSendService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->service->fetchNotifications();
        //return $this->respondWithSuccess($list);
        $items = ApiResource::collection($list);
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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $res = $this->service->markReadNotification($id);

            $res = [
                'message' => 'Notification Mark As Read'
            ];

            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = $this->service->deleteAllNotification();

            if ($res) {
                /** If item is deleted successfully */
                $res = [
                    'message' => 'Notifications Deleted'
                ];
                return $this->respondWithSuccess($res);
            }

            $res = [
                'message' => 'Notifications Not Deleted'
            ];
            /** If failed to delete item from db */
            return $this->respondWithError($res);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    /**
     * Update Status of the resource
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    function updateStatus($id)
    {
        //
    }

    public function markAllRead()
    {
        try {
            $res = $this->service->markAllReadNotification();

            $res = [
                'message' => 'All Notification Is Mark As Read'
            ];

            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function getNotificationCount(Request $request)
    {
        $user  = Auth::user();
        $list['count'] = $this->service->getNotificationCount();
        $list['role'] =  $user->role;
        return $this->respondWithSuccess($list);
    }
}
