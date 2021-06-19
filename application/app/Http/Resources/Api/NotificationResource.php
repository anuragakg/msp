<?php

namespace App\Http\Resources\Api;
use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            //'type' => $this->type,
            'created_at' => Carbon::parse($this->created_at)->format('d-M-Y h:i:s A'),
            'data' => $this->data
        ];
    }
}
