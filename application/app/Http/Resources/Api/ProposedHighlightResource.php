<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedHighlightResource extends JsonResource
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
            'activities' => basename($this->activities),
            'activities_url' => url($this->activities),

            'office_bearer' => basename($this->office_bearer),
            'office_bearer_url' => url($this->office_bearer),

            'establishment' => basename($this->establishment),
            'establishment_url' => url($this->establishment),

            'equipment' => basename($this->equipment),
            'equipment_url' => url($this->equipment),

            'training' => basename($this->training),
            'training_url' => url($this->training),

            'inventory' => basename($this->inventory),
            'inventory_url' => url($this->inventory),

            'operational_breakeven' => basename($this->operational_breakeven),
            'operational_breakeven_url' => url($this->operational_breakeven),

            'business_plan' => basename($this->business_plan),
            'business_plan_url' => url($this->business_plan),

            'retail_plan' => $this->retail_plan,
            'retail_plan_file' => basename($this->retail_plan_file),
            'retail_plan_file_url' => url($this->retail_plan_file),
            
            'transport_plan' => $this->transport_plan,
            'transport_plan_file' => basename($this->transport_plan_file),
            'transport_plan_file_url' => url($this->transport_plan_file),
        ];
    }
}
